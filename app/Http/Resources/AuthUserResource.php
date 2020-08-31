<?php

namespace App\Http\Resources;
use JWTAuth;
use Illuminate\Http\Resources\Json\JsonResource;


class AuthUserResource extends JsonResource
{
      /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $user = $this->resource;

        //Get the User Token
        $token = JWTAuth::fromUser($user);

        //Get USer Permissions - Loop through and get the name only
        $permissionsArr = $this->getAllPermissions();
        $permissions = [];
        foreach ($permissionsArr as $permission) {
            $permissions[] = $permission['name'];
        }


        //Get User Roles - Loop through and get the names only
        $rolesArr = $this->getRoleNames();
        $roles = [];
        foreach ($rolesArr as $role) {
            $roles[] = $role;
        }

        unset($user->permissions);
        unset($user->roles);


        return [
            "user"=>[
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,    
                'phone'=>$this->phone,
                'slug'=>$this->slug,
        
            ],
            'roles' =>$roles,
            'permissions'=>$permissions,
            "token"=>$token
        ];


    }
}
