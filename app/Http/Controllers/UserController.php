<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;

/**
 * @group Users
 *
 */
class UserController extends Controller
{
    /**
     * Authenticate user
     * 
     * Authenticate user using email address and password. Returns an api token for api authorization.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @queryParam email User's email address.
     * @queryParam password User's password.
     * 
     * @response {
     *  "api_token": "dkZEMWo1VFVuanhKejJobzF4VmVSZWNNWlZMdERvekl4MFFjMEtoNQ=="
     * }
     * @response 401 {
     *  "error": "login_failed"
     * }
     * 
     */
    public function authenticate(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $user_repo = new UserRepository(new User);        
        $user = $user_repo->findUserByEmail($request->email);

        if(is_null($user)) {
            return response()->json(['error' => 'login_failed'], 401);
        }

        if(app('hash')->check($request->input('password'), $user->password)) {
            $api_token = base64_encode(str_random(40));

            $user_repo = new UserRepository($user);
            $user_repo->update(['api_token' => $api_token]);

            return response()->json(['api_token' => $api_token]);
        }
        else {
            return response()->json(['error' => 'login_failed'], 401);
        }
    }
}
