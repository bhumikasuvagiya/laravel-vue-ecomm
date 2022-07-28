<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.category-list');
    }

    public function ajax_get_category_list(Request $request)
    {
        if ($request->ajax()) {

            $where_str    = "1 = ?";
            $where_params = array(1);
            if (!empty($request->get('sSearch'))) {
                $search     = $request->get('sSearch');
                $where_str .= " and (category_name like \"%{$search}%\""
                    . " or status like \"%{$search}%\""
                    . ")";
            }

            $columns = ['category_id', 'category_name', 'status', 'creation_datetime'];

          /*   $record_count = User::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count(); */

                $record_count =  Category::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count();

            $records = Category::select($columns)
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

    public function save_category(Request $request, $category_id = null)
    {
        if ($request->isMethod('get')) {
            if ($category_id != null) {
                $category = Category::find($category_id);
                return view('category.category-form', compact('category'));
            } else {
                return view('category.category-form');
            }
        } else {

            $request->validate([
                'category_name' => 'required',
                'category_status' => 'required',
            ]);

            if ($category_id) {
                $category_data = Category::find($category_id);
            } else {
                $category_data = new Category;
            }
            if ($request->category_image) {
                $file_upload_path = public_path('uploads/categories/' . date('Ym') . '');
                if (!empty($category_data->category_image)) {
    
                    if (\File::exists(public_path($category_data->category_image))) {
                        \File::delete(public_path($category_data->category_image));
                    }
            }
    
                $imageName = date('Ymd-his-') . rand(100, 999999) . '.' . $request->category_image->extension();
                $category_image_name = 'uploads/categories/' . date('Ym') . '' . '/' . $imageName;
                $request->category_image->move($file_upload_path, $imageName);	
                $category_data->category_image = $category_image_name;
            }
            $category_data->category_name = $request->category_name;
            $category_data->status = $request->category_status;
            $category_data->creation_datetime = date('Y-m-d h:i:s');

            try {
                $category_data->save();
                $message = "Record Saved Succesfully";
                return redirect()->route('categories')->with('success', $message);
            } catch (\Exception  $th) {
                echo $th->getMessage();
                $message = "Something went Wrong Please Try later!";
                return redirect()->route('categories')->with('error', $message);
            }
        }
    }

    public function del_single_category($category_id)
    {
        Category::where('category_id',$category_id)->delete();
    }

    public function deletemulticategory(Request $request)
    {
        Category::whereIn('category_id', $request->get('categories'))->delete();
        return redirect()->back()->with('success', 'Record Deleted successfully');
    }

    public function ajax_check_category(Request $request)
    {
        if ($request->category_id != '') {
            $user = Category::where('category_name', $request->category_name)->where('category_id', '!=', $request->category_id)->first();
        } else {
            $user = Category::where('category_name', $request->category_name)->first();
        }
        if ($user) {
            return response()->json('Category Already Taken. Try Another');
        } else {
            return response()->json(true);
        }
    }
}
