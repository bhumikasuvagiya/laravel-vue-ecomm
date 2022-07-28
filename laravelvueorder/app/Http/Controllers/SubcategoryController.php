<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('subcategory.subcategory-list');
    }
    public function ajax_get_subcategory_list(Request $request)
    {
        if ($request->ajax()) {

            $where_str    = "1 = ?";
            $where_params = array(1);
            if (!empty($request->get('sSearch'))) {
                $search     = $request->get('sSearch');
                $where_str .= " and (subcategory_name like \"%{$search}%\""
                    . " or subcategory.status like \"%{$search}%\""
                    . " or category_name like \"%{$search}%\""
                    . ")";
            }

            $columns = ['subcategory_id', 'category.category_id', 'subcategory_name', 'subcategory.status', 'subcategory.creation_datetime', 'category_name'];

            /*   $record_count = User::select($columns)
                ->whereRaw($where_str, $where_params)
                ->count(); */

            $record_count =  Subcategory::join('category', 'category.category_id', '=', 'subcategory.category_id')
                ->select($columns)
                ->whereRaw($where_str, $where_params)
                ->count();

            $records = Subcategory::join('category', 'category.category_id', '=', 'subcategory.category_id')
                ->select($columns)
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

    public function save_subcategory(Request $request, $subcategory_id = null)
    {
        if ($request->isMethod('get')) {
            $category = Category::get();
            if ($subcategory_id != null) {
                $subcategory = Subcategory::find($subcategory_id);
                return view('subcategory.subcategory-form', compact('subcategory', 'category'));
            } else {
                return view('subcategory.subcategory-form', compact('category'));
            }
        } else {

            $request->validate([
                'subcategory_name' => 'required',
                'category' => 'required',
                'subcategory_status' => 'required',
            ]);

            if ($subcategory_id) {
                $subcategory_data = Subcategory::find($subcategory_id);
            } else {
                $subcategory_data = new Subcategory;
            }
            if ($request->subcategory_image) {
                $file_upload_path = public_path('uploads/subcategories/' . date('Ym') . '');
                if (!empty($subcategory_data->subcategory_image)) {
    
                    if (\File::exists(public_path($subcategory_data->subcategory_image))) {
                        \File::delete(public_path($subcategory_data->subcategory_image));
                    }
                }
    
                $imageName = date('Ymd-his-') . rand(100, 999999) . '.' . $request->subcategory_image->extension();
                $subcategory_image_name = 'uploads/subcategories/' . date('Ym') . '' . '/' . $imageName;
                $request->subcategory_image->move($file_upload_path, $imageName);	
                $subcategory_data->subcategory_image = $subcategory_image_name;
            }
            $subcategory_data->category_id = $request->category;
            $subcategory_data->subcategory_name = $request->subcategory_name;
            $subcategory_data->status = $request->subcategory_status;
            $subcategory_data->creation_datetime = date('Y-m-d h:i:s');

            try {
                $subcategory_data->save();
                $message = "Record Saved Succesfully";
                return redirect()->route('subcategories')->with('success', $message);
            } catch (\Exception  $th) {
                echo $th->getMessage();
                $message = "Something went Wrong Please Try later!";
                return redirect()->route('subcategories')->with('error', $message);
            }
        }
    }

    public function del_single_subcategory($subcategory_id)
    {
        Subcategory::where('subcategory_id', $subcategory_id)->delete();
    }

    public function deletemultisubcategory(Request $request)
    {
        Subcategory::whereIn('subcategory_id', $request->get('subcategories'))->delete();
        return redirect()->back()->with('success', 'Record Deleted successfully');
    }
    public function ajax_check_subcategory_by_category(Request $request)
    {
        if ($request->subcategory_id != '') {
            $user = Subcategory::where('subcategory_name', $request->subcategory_name)->where('subcategory_id', '!=', $request->subcategory_id)->where('category_id', $request->category_id)->first();
        } else {
            $user = Subcategory::where('subcategory_name', $request->subcategory_name)->where('category_id', $request->category_id)->first();
        }
        if ($user) {
            return response()->json('Subcategory Already Taken. Try Another');
        } else {
            return response()->json(true);
        }
    }
}
