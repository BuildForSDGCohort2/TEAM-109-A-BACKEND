<?php

namespace App\Http\Controllers;
use App\Enums\Roles;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\LoginInputFormReqest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AuthUserResource;
use Illuminate\Support\Carbon;
use App\Jobs\AccountCreationSendEmailJob;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\RequestValidationException;


use App\User;

class UserController extends Controller
{
    //
    protected $users;


    public function signInUser(LoginInputFormReqest $request){


        $user = User::where("email",$request->email)->first();
        if(!Hash::check($request->password,$user->password)) throw new RequestValidationException("Invalid account credentials provided");

        return response()->json([
            "status"=>true,
            "data"=> new AuthUserResource($user),
            "message"=>"Login successful"
        ]);
    

    }

    public function  signOutUser(){
        auth()->logout();
    }

    public function store(UserRegisterRequest $request)
    {

        // return $request;
        
            DB::beginTransaction();

            $this->users =  $this->created($request);

            DB::commit();


            try{
                //create a JOB and delay it for 5 seconds
                $job = (new AccountCreationSendEmailJob($this->users))->delay(Carbon::now()->addSecond(5));
                dispatch($job);

            }catch (\Exception $e){
                Log::info($e->getMessage());
            }

            return response()->json([
                'status' => true,
                "data"=> new AuthUserResource($this->users),
                "message"=>"Account Created successfully"
            ]);

    }

    public function created($request){

        $user = new User;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = bcrypt($request->password);
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->community_id = $request->community_id;
        $user->slug = User::generateVerificationCode();


        $user->save();

        
        $this->assignRoleToNewUser($request->role, $user);
   
       
        return $user;

    }

    public function assignRoleToNewUser($role_given, $user){
        // Role::create(['name'=>'FARMETR'])

       if($role_given === Roles::FARMER) {
            $roleToAssign = Role:: findByName(Roles::FARMER, 'api');
            $user->assignRole($roleToAssign);
        }

        if($role_given === Roles::PROCESSOR) {
            $roleToAssign = Role:: findByName(Roles::PROCESSOR, 'api');
            $user->assignRole($roleToAssign);
        }

        if($role_given === Roles::STORAGE) {
            $roleToAssign = Role:: findByName(Roles::STORAGE, 'api');
            $user->assignRole($roleToAssign);
        }

        if($role_given === Roles::ADMIN) {
            $roleToAssign = Role:: findByName(Roles::ADMIN, 'api');
            $user->assignRole($roleToAssign);
        }

        if($role_given === Roles::SUPER_ADMIN) {
            $roleToAssign = Role:: findByName(Roles::SUPER_ADMIN, 'api');
            $user->assignRole($roleToAssign);
        }
    }
}
