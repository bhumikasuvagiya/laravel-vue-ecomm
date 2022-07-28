<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FrontendApisController extends Controller
{
    public function get_category_api()
	{
		return Category::get(); 
	}
 
	public function get_products_api()
	{
		return Product::get(); 
	}
	public function get_all_subcategories()
	{
		return Subcategory::get(); 
	}
	public function product_sorting($sortKey)
	{
		if($sortKey == 'high'){
			$column = 'amount';
			$orderby = 'DESC';
		}elseif ($sortKey == 'low'){
			$column = 'amount';
			$orderby = 'ASC';
		}elseif ($sortKey == 'latest') {
			$column = 'product_id';
			$orderby = 'DESC';
		}else if($sortKey == 'all'){
			$column = 'product_id';
			$orderby = 'ASC';
		}
		$productData = Product::orderBy($column , $orderby)->get();
		return $productData;
	}
	
	public function get_subcategory($category_id = null)
	{
		if($category_id){
			return Subcategory::where('category_id',$category_id)->get();
		}
	}
	public function sortbysubcat($sortKey = '',$subcategoryid = null)
	{
		if($sortKey == 'high'){
			$column = 'amount';
			$orderby = 'DESC';
		}elseif ($sortKey == 'low'){
			$column = 'amount';
			$orderby = 'ASC';
		}elseif ($sortKey == 'latest') {
			$column = 'product_id';
			$orderby = 'DESC';
		}else if($sortKey == 'all'){
			$column = 'product_id';
			$orderby = 'ASC';
		}
		$productData = Product::where('subcategory_id',$subcategoryid)->orderBy($column , $orderby)->get();
		return $productData;
	}
	public function sortbycat($sortKey = '',$categoryid = null)
	{
		if($sortKey == 'high'){
			$column = 'amount';
			$orderby = 'DESC';
		}elseif ($sortKey == 'low'){
			$column = 'amount';
			$orderby = 'ASC';
		}elseif ($sortKey == 'latest') {
			$column = 'product_id';
			$orderby = 'DESC';
		}else if($sortKey == 'all'){
			$column = 'product_id';
			$orderby = 'ASC';
		}
		$productData =	Product::join('subcategory', 'subcategory.subcategory_id', '=', 'product.subcategory_id')
                ->join('category', 'category.category_id', '=', 'subcategory.category_id')
                ->select("category.category_name","product.*","subcategory.*")->where('subcategory.category_id',$categoryid)->orderBy($column , $orderby)->get();
		return $productData;
	}
	public function get_products_by_subcat($subcategory_id = null)
	{
		if($subcategory_id){
			return Product::where('subcategory_id',$subcategory_id)->get();
		}
	}
	public function get_single_subcategory($subcategory_id = null)
	{
		if($subcategory_id){
			return Subcategory::where('subcategory_id',$subcategory_id)->first();
		}
	}
	public function get_single_category($category_id = null)
	{
		if($category_id){
			return Category::where('category_id',$category_id)->first();
		}
	}
	public function get_category_products($category_id = null)
	{
		if($category_id){
			$data =	Product::join('subcategory', 'subcategory.subcategory_id', '=', 'product.subcategory_id')
                ->join('category', 'category.category_id', '=', 'subcategory.category_id')
                ->select("category.category_name","product.*","subcategory.*")->where('subcategory.category_id',$category_id)->get();
			return $data;
		}
	}
	public function get_category_by_subcategory($subcategory_id)
	{
		if($subcategory_id){
			$data =	Subcategory::join('category', 'category.category_id', '=', 'subcategory.category_id')
                ->select("category.*","subcategory.*")->where('subcategory.subcategory_id',$subcategory_id)->first();
			return $data;
		}
	}

    public function store_user(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $hashed = Hash::make($request['password']);
       
            $user = new User;
        
        $user->name = $request['name'];
        $user->password = $hashed;
        $user->email = $request['email'];
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Successfull Register',
        ]);
    }
    public function login(Request $request)
    {
        $ori_password = md5($request['password']);
        $user = User::where('email', $request['email'])->first();

        if (! $user || !$ori_password == $user->password) {
            return response()->json([
                'success' => false,
                'error' => 'The provided credentials are incorrect',
            ]);
        }
        
        $success =  $user->createToken($request['email'])->accessToken;
        
        return response()->json([
            'success' => true,
            'token' => $success->token,
            'message' => 'Successfull Login',
            'token_type' => 'Bearer',
        ]);
        
    }
    public function getAuthUser(Request $request)
    {
        // return $request->header);

        // echo "<pre>"; print_r($request->header()); die;
        // return $request->header();
        $access_token = $request->header('authorization');

        // $auth_header = explode(' ', $access_token);

        // // echo "<pre>"; print_r($access_token); die;
        $user_id = DB::table('personal_access_tokens')->where('token', $access_token)->first();

        $user = User::where('email', $user_id->name)->first();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }
    public function myaccount( Request $request , $user_id = null)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $hashed = Hash::make($request['password']);
        if ($user_id) {
            $user = User::find($user_id);
        }

        $user->name = $request['name'];
        $user->password = $hashed;
        $user->email = $request['email'];
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Your Details Saved Successfully',
        ]);
    }
    public function order_store(Request $request)
	{
        
        // return $request->all();
		$request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_phone_number' => 'required',
            'shipping_city' => 'required',
            'shipping_address' => 'required',
            'shipping_state' => 'required',
            'shipping_zip' => 'required',
            'shippping_country' => 'required',
            'order_total' => 'required',
            'payment_method_type' => 'required',
        ]);


        $order = new Order();
        $order->customer_name = $request['customer_name'];
        
        $order->customer_email = $request['customer_email'];
        $order->customer_phone_number = $request['customer_phone_number'];
        $order->shipping_city = $request['shipping_city'];
        $order->shipping_address = $request['shipping_address'];
        $order->shipping_state = $request['shipping_state'];
        $order->shipping_zip = $request['shipping_zip'];
        $order->shippping_country = $request['shippping_country'];
        $order->order_total = $request['order_total'];
        $order->payment_method_type = $request['payment_method_type'];
        $order->order_note = $request['order_note'];
        $order->creation_datetime = date('Y-m-d H:i:s');
        
        $order->save();

        if (!empty($order)) {
            $order->save();
            $lastInsertedId = $order->order_id;
        }   
        
        foreach ($request->dataItems as $order_items) {
            $orderitemsdata = new OrderItem();
            $orderitemsdata->order_id = $lastInsertedId;
            $orderitemsdata->product_id = $order_items['product_id'];
            $orderitemsdata->product_quantity = $order_items['product_quantity'];
            $orderitemsdata->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order Saved Successfully',
            'order_id' => $lastInsertedId,
        ]);
	}
    public function setting_data()
	{
		return Setting::orderBy('setting_id','DESC')->first(); 
	}
}
