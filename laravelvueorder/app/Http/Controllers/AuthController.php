<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->session()->has('loginUser')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function ajaxlogin(Request $request)
    {

        if ($request->ajax()) {
            if ($request->session()->has('loginUser')) {
                return redirect()->route('dashboard');
            }
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                )); // 400 being the HTTP code for an invalid request.
                $error = $validator->errors();
                return $error->messages();
            }
            if ($request->method() == "POST" && $request->has('email')) {

                $data = User::where('email', $request->email)->first();
                // echo "<pre>"; print_r($data); die;

                    if (!empty($data) && (md5($request->password) == $data['password']) == true) {
                        if ($request->rememberme != 1) {
                            setcookie('email', $request->email, time() - 3600);
                            setcookie('password', $request->password, time() - 3600);
                        } else {
                            setcookie('email', $request->email, time() + 86500);
                            setcookie('password', $request->password, time() + 86500);
                        }
                        if($data['status'] == 0){
                            return Response::json(array(
                                'success' => false,
                                'invalidemail' => 'Your Account is Blocked. Contact Administrater'
                            ));
                        }else {
                            $sessiondata['user_name'] = $data['first_name'] . ' ' . $data['last_name'];
                            $sessiondata['user_id'] = $data['id'];
                            $sessiondata['user_email'] = $data['email'];
                            $request->session()->put('loginUser', $sessiondata);
                            return Response::json(array('success' => true));
                        }
                    
                } else {
                    return Response::json(array(
                        'success' => false,
                        'invalidemail' => 'The Email or password is Incorrect!'
                    ));
                }
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('loginUser');
        return redirect()->route('login');
    }

    public function index(Request $request)
    {
        return view('dashboard');
    }
}
