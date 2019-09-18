<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\LoginUser;
use App\User;
use App\Follower;
use App\UserAnnotote;
use Illuminate\Support\Facades\Hash;
use App\UserVerification;
use Illuminate\Support\Facades\Mail;
use App\ForgetPassword;

class AuthController extends Controller {

    //
    function login(Request $request) {
        $validator = Validator::make($request->all(), [
                    'device_id' => 'required',
                    'device_type' => 'required',
                    'email' => 'required|email|max:50',
                    'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->input('password')])) {
            $user = User::where('id', Auth::id())->with('userTags')->first();
            if (!$user->verified) {
                return sendError('Please verify Email');
            }
            $user->isFollowed = 0;
            if (!$user->last_login) {
                User::where('id', $user->id)->update(['last_login' => time(), 'tutorial_status' => 1]);
            } else {
                User::where('id', $user->id)->update(['last_login' => time()]);
            }
            $followers = Follower::select('follows_id')->where('follower_id', $user->id)->get()->toArray();
            $follower_tottes = UserAnnotote::whereIn('user_id', $followers)
                            ->with('annototeHeighlight', 'annototeTags')->get();
            $user->followTote = $follower_tottes;
            $data['user'] = $user;
            $data['status'] = 1;
            $data['access_token'] = $this->saveLoginUserDetail($user, $request)->session_key;
            return sendSuccess('Login successfully', $data);
        } else {
            return sendError('Invalid Email or password');
        }
    }

    function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'email' => 'required|email|unique:users', // required and must be unique in the ducks table
                    'password' => 'required|min:6',
                    'platform' => 'required',
                    'created_at' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return sendError($errors);
        }
        $DbUser = new User();
        $DbUser->first_name = $request->first_name;
        $DbUser->last_name = $request->last_name;
        $DbUser->email = $request->email;
        $DbUser->password = Hash::make($request->password);
        $DbUser->verified = 0;
        $DbUser->platform = $request->platform;
        $DbUser->platform_id = $request->platform_id;
        $DbUser->created_at = $request->created_at;
        $DbUser->updated_at = $request->updated_at;
        $DbUser->save();
        $add_verification = new UserVerification;
        $add_verification->token = time();
        $add_verification->user_id = $DbUser->id;
        $add_verification->save();
        $data['user'] = $add_verification;
        Mail::send('mails.verificationMailView', $data, function($message) use ($DbUser) {
            $message->from(env('MAIL_USERNAME'), 'Annotote');
            $message->to($DbUser->email);
            $message->subject('Annotote Registration');
        });
        $data['user'] = $DbUser;
        return sendSuccess('Register successfully', $data);
    }

    private function saveLoginUserDetail(User $user, Request $request) {
        $newLoginUser = new LoginUser();
        $newLoginUser->session_key = bcrypt($user->id);
        $newLoginUser->device_id = $request->input('device_id');
        $newLoginUser->device_type = $request->input('device_type');
        $newLoginUser->user_id = $user->id;
        $newLoginUser->created_at = time();
        $newLoginUser->updated_at = time();
        $newLoginUser->save();


        return $newLoginUser;
    }

    function verify($token) {
        $check_token = UserVerification::where('token', $token)->first();
        if (!$check_token) {
            echo '<strong>Sorry Page Not Found</strong>';
        } else {
            $user = User::find($check_token->user_id);
            $user->verified = 1;
            $user->save();
            $check_token->delete();
            return view('verification_view');
        }
    }

    function forgotPassword(Request $request) {
        $check_token = User::where('email', $request->email)->first();
        if (!$check_token) {
            return sendError('Sorry Email Not Found');
        }
        $token = substr(uniqid(), 6, 6);
        $add_verification = new ForgetPassword;
        $add_verification->token = $token;
        $add_verification->user_id = $check_token->id;
        $add_verification->save();
        $data['passwordToken'] = $token;
        Mail::send('mails.forgotPasswordMailView', $data, function ($m) use ($request) {
            $m->from(env('MAIL_USERNAME'), 'Annotote');
            $m->to($request->input('email'));
            $m->subject('Forget Password');
        });
        return sendSuccess('Email Has sent to you with instructions');
    }

    function reset($token) {
        $check_token = ForgetPassword::where('token', $token)->first();
        if ($check_token) {
            $data['token'] = $token;
            return view('change_password_view', $data);
        } else {
            echo '<strong>Sorry Page Not Found</strong>';
        }
    }

    function updatePassword(Request $request) {
        $check_token = ForgetPassword::where('token', $request->token)->first();
        if ($check_token) {
            $user = User::find($check_token->user_id);
            $user->password = Hash::make($request->password);
            $user->save();
            $check_token->delete();
            return view('password_change_verification_view');
        } else {
            echo '<strong>Sorry Page Not Found</strong>';
        }
    }

}
