<?php

namespace App\Http\Controllers;
use App\Enums\Roles;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AuthUserResource;
use Illuminate\Support\Carbon;
use App\Jobs\AccountCreationSendEmailJob;
use Illuminate\Support\Facades\Log;

use App\User;

class UserController extends Controller
{
    //
    protected $users;

    public function store(Request $request)
    {
        
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

        $user->fname = $request->firstname;
        $user->lname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->image = $request->image->store('');
        $user->password = bcrypt($request->password);
        $user->slug = User::generateVerificationCode();


        $user->save();
        $user->assignRole(Roles::CUSTOMER);
        return $user;

    }
}
