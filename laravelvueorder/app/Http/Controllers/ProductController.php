<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('product.product-list');
    }
    public function ajax_get_product_list(Request $request)
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
                $where_str .= " and (category_name like \"%{$search}%\""
                    . " or subcategory_name like \"%{$search}%\""
                    . " or product_name like \"%{$search}%\""
                    . " or product.status like \"%{$search}%\""
                    . ")";
            }

            $columns = ['product_id', 'category.category_id', 'subcategory.subcategory_id', 'product_name', 'product_sku','description', 'product.status', 'product.creation_datetime', 'product_image', 'category_name','amount','subcategory_name'];

            /*   $record_count = User::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count(); */


            $record_count =  Product::join('category', 'category.category_id', '=', 'product.category_id')
                ->join('subcategory', 'subcategory.subcategory_id', '=', 'product.subcategory_id')
                ->select($columns)
                ->whereRaw($where_str, $where_params)
                ->count();

            $records = Product::join('category', 'category.category_id', '=', 'product.category_id')
                ->join('subcategory', 'subcategory.subcategory_id', '=', 'product.subcategory_id')
                ->select($columns)
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


    public function save_product(Request $request, $product_id = null)
    {
        if ($request->isMethod('get')) {

            $category = Category::get();
            if ($product_id != null) {
                $product = Product::find($product_id);
                $subcategory = Subcategory::where('category_id', $product->category_id)->get();
                return view('product.product-form', compact('category', 'product', 'subcategory'));
            } else {
                return view('product.product-form', compact('category'));
            }
        } else {

                // echo "<pre>"; print_r($request->all()); die;
            $request->validate([
                'category' => 'required',
                'subcategory' => 'required',
                'product_name' => 'required',
                'product_status' => 'required',
            ]);

            if ($product_id) {
                $product_data = Product::find($product_id);
            } else {
                $product_data = new Product;
            }
            if ($request->product_image) {
                $file_upload_path = public_path('uploads/products/' . date('Ym') . '');
                if (!empty($product_data->product_image)) {
    
                    if (\File::exists(public_path($product_data->product_image))) {
                        \File::delete(public_path($product_data->product_image));
                    }
                }
    
                $imageName = date('Ymd-his-') . rand(100, 999999) . '.' . $request->product_image->extension();
                $product_image_name = 'uploads/products/' . date('Ym') . '' . '/' . $imageName;
                $request->product_image->move($file_upload_path, $imageName);	
                $product_data->product_image = $product_image_name;
            }

            $user_id = $request->session()->get('loginUser')['user_id'];
            $product_data->category_id = $request->category;
            $product_data->subcategory_id = $request->subcategory;
            $product_data->product_name = $request->product_name;
            $product_data->product_sku = $request->product_sku;
            $product_data->description = $request->description;
            $product_data->amount = $request->amount;
            $product_data->status = $request->product_status;
            $product_data->creation_datetime = date('Y-m-d h:i:s');
            // echo "<pre>"; print_r($product_data); die;
            if (!empty($product_data)) {
                $product_data->save();
            }

            $message = "Record Saved Succesfully";
            return redirect()->route('product')->with('success', $message);
        }
    }

    public function ajax_get_subcategory(Request $request)
    {
        if ($request->category_id) {
            $subcategory_data = Subcategory::where('category_id', $request->category_id)->get();
        }
        return response()->json($subcategory_data);
    }

    public function del_single_product($product_id)
    {
        Product::where('product_id', $product_id)->delete();
    }

    public function deletemultiproduct(Request $request)
    {
        Product::whereIn('product_id', $request->get('product_data'))->delete();

        return redirect()->back()->with('success', 'Record Deleted successfully');
    }
    public function ajax_check_product_name(Request $request)
    {
        if ($request->product_id != '') {
            $where_params = array(1);
            $where_str = "product_name = '$request->product_name' and product_id != '$request->product_id' and category_id = '$request->category' and subcategory_id = '$request->subcategory' ";
            $product = Product::whereRaw($where_str, $where_params)
                ->first();
        } else {
            $product = Product::where('product_name', $request->product_name)->where('category_id', $request->category)->where('subcategory_id', $request->subcategory)->first();
        }
        // echo "<pre>"; print_r($product); die;
        if ($product) {
            return response()->json('Product Already Taken. Try Another');
        } else {
            return response()->json(true);
        }
    }
    public function ajax_check_sku_name(Request $request)
    {
        if ($request->product_id != '') {
            $where_params = array(1);
            $where_str = "product_sku = '$request->product_sku' and product_id != '$request->product_id' ";
            $product = Product::whereRaw($where_str, $where_params)
                ->first();
        } else {
            $product = Product::where('product_sku', $request->product_sku)->first();
        }
        // echo "<pre>"; print_r($product); die;
        if ($product) {
            return response()->json('Sku Already Taken. Try Another');
        } else {
            return response()->json(true);
        }
    }
}
