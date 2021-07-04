<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Requests\SignInPostRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /* 會員註冊 */
    public function register(RegisterPostRequest $request)
    {
        $registerPost = $request->all();

        $database = new User;
        $result = $database->register($registerPost);

        if ($result == true) {
            return response('會員註冊成功');
        }
    }

    /* 會員登入 */
    public function signIn(SignInPostRequest $request)
    {
        $signInPost = $request->all();

        if (Auth::attempt($signInPost)) {
            $member = $request->user();
            $Token = $member->createToken('token');
            $Token->token->save();
            return response(['accessToken' => $Token->accessToken]);
        } else {
            return response('登入失敗，請重新登入');
        }
    }

    /* 取得會員資料 */
    public function member(Request $request)
    {
        $member_data = $request->user();

        return response($member_data);
    }

    /* 會員登出 */
    public function signOut(Request $request)
    {
        $request->user()->token()->revoke();

        return response('登出成功');
    }
}
