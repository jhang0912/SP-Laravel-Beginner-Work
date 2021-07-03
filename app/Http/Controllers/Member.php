<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterPostRequest;
use App\Models\User;

class Member extends Controller
{
    /* 會員註冊 */
    public function register(RegisterPostRequest $request)
    {
        $registerPost = $request->all();

        User::make([
            'name' => $registerPost['name'],
            'email' => $registerPost['email'],
            'password' => bcrypt($registerPost['password'])
        ])
        ->save();

        return response('會員註冊成功');
    }

    /* 會員登入 */
    
}
