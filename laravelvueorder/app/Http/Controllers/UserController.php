<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.user-list');
    }

    public function ajax_get_user_list(Request $request)
    {
        if ($request->ajax()) {
        
            $where_str    = "1 = ?";
            $where_params = array(1);
            if (!empty($request->get('sSearch'))) {
                $search     = $request->get('sSearch');
                $where_str .= " and (first_name like \"%{$search}%\""
                    . " or email like \"%{$search}%\""
                    . " or last_name like \"%{$search}%\""
                    . ")";
            }
        
            $columns = ['id', 'email', 'password', 'first_name', 'last_name', 'status', 'creation_datetime'];

              $record_count = User::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count();
            
                $records = User::select($columns)
                ->whereRaw($where_str, $where_params);
                
            // echo "<pre>"; print_r($records);  die;


            if ($request->get('iDisplayStart') != '' && $request->get('iDisplayLength') != '') {
                $records = $records->take($request->get('iDisplayLength'))
                    ->skip($request->get('iDisplayStart'));
            }

            if ($request->get('iSortCol_0')) {
                $sql_order = '';
                for ($i = 0; $i < $request->get('iSortingCols'); $i++) {
                    $column = $columns[$request->get('iSortCol_' . $i)];
                    if (false !== ($index = strpos($column, ' as '))) {
                        $column = substr($column, 0, $index);
                    }
                    $records = $records->orderBy($column, $request->get('sSortDir_' . $i));
                }
            }
            $records = $records->get();
            $response['iTotalDisplayRecords'] = $record_count;
            $response['iTotalRecords'] = $record_count;
            $response['sEcho'] = intval($request->get('sEcho'));
            $response['aaData'] = $records->toArray();



            return $response;
        }
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function save_user(Request $request, $user_id = null)
    {
        if ($request->isMethod('get')) {
            $user_password = $this->generateRandomString(8);
            if ($user_id != null) {
                $user = User::find($user_id);
                return view('user.user-form', compact('user', 'user_password'));
            } else {
                return view('user.user-form', compact('user_password'));
            }
        } else {


            $request->validate([
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'user_status' => 'required',
            ]);


            if ($user_id) {
                $user_data = User::find($user_id);
            } else {
                $user_data = new User;
            }

            $user_data->first_name = $request->firstname;
            $user_data->last_name = $request->lastname;
            $user_data->email = $request->email;

            if ($request->password != '' && $request->password_chk == '1') {
                $user_data->password = md5($request->password);
            } else {
                $user_data->password = md5($request->password);
            }
            $user_data->status = $request->user_status;
            $user_data->telephone = $request->telephone;
            $user_data->creation_datetime = date('Y-m-d h:i:s');

            try {

                $user_data->save();

                $message = "Record Saved Succesfully";
                return redirect()->route('users')->with('success', $message);
            } catch (\Exception  $th) {
                echo $th->getMessage();

                // $message = "Something went Wrong Please Try later!";
                // return redirect()->route('users')->with('error', $message);
            }
        }
    }

    public function del_single_user($user_id)
    {
        User::where('id', $user_id)->delete();
    }

    public function deletemultiuser(Request $request)
    {
        User::whereIn('id', $request->get('users'))->delete();
        return redirect()->back()->with('success', 'Record Deleted successfully');
    }

    public function ajax_check_users_email(Request $request)
    {
        if ($request->user_id != '') {
            $user = User::where('email', $request->email)->where('id', '!=', $request->user_id)->first();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        if ($user) {
            return response()->json('Email Already Taken. Try Another');
        } else {
            return response()->json(true);
        }
    }

    function user_profile_form(Request $request)
    {
        if ($request->ajax()) {
            $user_id =  $request->session()->get('loginUser')['user_id'];
            $user = User::where('id', $user_id)->first();
            // $data['user_role_data'] = model('CommonModel')->common_get_record('user_type', '')->getResultArray();
            $user_data = view('user.user-profile-form', compact('user'))->render();
            return response()->json($user_data);
        }
    }

    function ajax_get_user_data(Request $request)
    {
        if ($request->ajax()) {
            $user_id =  $request->session()->get('loginUser')['user_id'];
            $user = User::where('id', $user_id)->first();
            return response()->json($user);
        }
    }

    function ajax_save_user_profile(Request $request)
    {
        if ($request->ajax()) {
            $user_id =  $request->session()->get('loginUser')['user_id'];
            $user = User::where('id', $user_id)->first();
            if (!empty($user)) {
                $user_data = User::find($user_id);
                $user_data->first_name = $request->firstname;
                $user_data->last_name = $request->lastname;
                $user_data->email = $request->email;
                if (!empty($request->new_password)) {
                    $user_data->password = md5($request->new_password);
                }
                $user_data->creation_datetime = date('Y-m-d h:i:s');
                $user_data->save();
                $r_data = 1;
            }
            return response()->json($r_data);
        }
    }

    function ajax_check_password(Request $request)
    {
        if ($request->ajax()) {
            $user_pass = md5($request->old_password);

            $user_id =  $request->session()->get('loginUser')['user_id'];
            $user = User::where('id', $user_id)->where('password',$user_pass)->first();
            if (!$user) {
                return response()->json('Your Current Password Wrong.');
            } else {
                return response()->json(true);
            }
        }
    }
}
