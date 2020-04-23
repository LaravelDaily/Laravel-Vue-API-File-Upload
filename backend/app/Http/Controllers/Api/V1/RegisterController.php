<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class RegisterController
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'avatar'   => ['image', 'dimensions:max_width=1000,max_height=1000'],
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $file = $request->file('avatar');
        $name = '/avatars/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);

        $data['avatar'] = $name;

        $user = User::create($data);

        return new UserResource($user);
    }

}
