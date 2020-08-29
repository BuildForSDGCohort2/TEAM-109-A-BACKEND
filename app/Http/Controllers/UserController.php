<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AuthUserResource;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    //

    public function store(UserRegisterRequest $request)
    {

        // $decodeImage = $this->getDecodedImage($request->image);

        // return $result = $this->awsService->handleFacialRecognition([
        //     "image" => $decodeImage,
        //     "check_face_detection" => true,
        //     "gender" => $request->gender,
        // ]);
        
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
}
