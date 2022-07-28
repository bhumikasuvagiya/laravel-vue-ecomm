<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    public function order_store(Request $request)
	{
        // return $request->dataItems; 
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


        // echo "<pre>"; print_r($$request->dataItems); die;
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

    public function orders_view()
    {
        return view('orders.order_list');
    }
    public function ajax_get_order_list(Request $request)
    {
        if ($request->ajax()) {

            $where_str    = "1 = ?";
            $user_id = $request->session()->get('loginUser')['user_id'];
            // if ($request->session()->get('loginUser')['user_type'] != USER_TYPE_ADMIN) {
            //     $where_str = "id = '$user_id' ";
            // }
            $where_params = array(1);
            if (!empty($request->get('sSearch'))) {
                $search     = $request->get('sSearch');
                $where_str .= " and (creation_datetime like \"%{$search}%\""
                    . " or customer_name like \"%{$search}%\""
                    . " or customer_email like \"%{$search}%\""
                    . " or shipping_city like \"%{$search}%\""
                    . " or shippping_country like \"%{$search}%\""
                    . " or shipping_zip like \"%{$search}%\""
                    . " or shipping_state like \"%{$search}%\""
                    . ")";
            }

            $columns = ['order_id', 'customer_name', 'customer_email', 'customer_phone_number','shipping_city', 
            'shipping_address', 'shipping_state', 'shipping_zip', 'shippping_country','order_total','payment_method_type','order_note','creation_datetime'];

            /*   $record_count = User::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count(); */


            $record_count =  Order::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count();

            $records = Order::select($columns)
                ->whereRaw($where_str, $where_params);


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
    function order_details_form_popup($order_id = null)
	{
        $order_data = OrderItem::join('product', 'product.product_id', '=', 'order_item.product_id')
        ->select('order_item.*','product.*')
        ->where('order_item.order_id', $order_id)
        ->get();
        $order_details = Order::where('order_id', $order_id)->first();
        // echo "<pre>"; print_r('order_data') die; 

        $order_view = view('orders.order_detail_popup', compact('order_data','order_details'))->render();
            return response()->json(array(
            'order_view' => $order_view,
        ));
	}
}
