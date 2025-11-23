<?php

namespace App\Http\Controllers\backend\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Traits\HandelErrorSuccess;
use App\Traits\ManageImage;
use App\Models\Category;

class CategoryController extends Controller
{
    use ManageImage,HandelErrorSuccess;

//  Manage Category Start
    public function manageCategory()
    {
        if (request()->ajax()) {
            $query = Category::get();
            return DataTables::of($query)
                ->addColumn('action', function ($data) {
                    $button = '<div>';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
                    $button .= '</div>';

                    $button .= '<div style="margin-top: 5px;">';
                    $button .= '<button name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm confirmDelete" record="Category" recordid="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->toJson();
        } else {
            return view("admin.extends.category.manage_category");
        }
    }
// Manage Category End

// Store Category Start
    public function storeCategory(Request $request)
    {
        try {
            DB::beginTransaction();
            if($request->isMethod("POST")){
                 $request->validate([
                "category_name" => "required|unique:categories,category_name",
                "category_image" => "required",
                "category_details" => "required"

            ]);

            $imageName = $this->storeImage($request->category_image, 'picture/category_image');

            $data = [
                "category_name" => $request->category_name,
                "category_image" => $imageName,
                "category_details" => $request->category_details,
                "created_at" => Carbon::now()
            ];

            DB::table("categories")->insert($data);
            DB::commit();
            Log::info('Category Successfully Stored!');
            return $this->success("Category Successfully Created!");

            }
             return view("admin.extends.category.store_category");
           
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error("Validation Error In Store Category." .$e);
            return $this->validationError($e,"Please provide a valid input.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error in storeCategory: " . $e->getMessage());
            return $this->genericError($e,"Under Maintenance.Please try again later or contact your service provider.");
        }
    }
//  Store Category End

//  Show Category Start
    public function showCategory($id)
    {
        try{
            $data=DB::table("categories")->where("id",$id)->first();
            if(empty($data)){
              Log::info("Category Not Found for ID: {$id}");
               return $this->notFoundError('Category Not Found!');
            }
            Log::info("Data Successfully Fetched For Id: {$id}");
            return $this->success("Data Successfully Fetched!");
        }
        catch(\Exception $e){
            Log::error("Error in showCategory: " . $e->getMessage());
            return $this->genericError($e,"Data Fetch Unsuccessful!");
        }
    }
//  Show Category End

// Edit Category Start
    public function editCategory($id)
    {
        try{
            $data=DB::table("categories")->where("id",$id)->first();
            if(empty($data)){
            Log::info("Category Not Found for ID: {$id}");
            return $this->notFoundError('Category Not Found!');
            }
            return response()->json($data);
        }
        catch(\Exception $e){
            Log::error("Error in editCategory: " . $e->getMessage());
            return $this->genericError($e,"Data Fetch Unsuccessful!");
        }
    }
//  Edit Category End

//  Update Category Start
    public function updateCategory(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                "category_name" => "required|unique:categories,category_name," . $id,
                "category_image" => "nullable|image|mimes:jpg,jpeg,png",
                "category_details" => "required"
            ]);
            
            $category_data = DB::table("categories")->where("id", $id)->first();
            if (empty($category_data)) {
                Log::info("Category Not Found For Id: {$id}");
                return $this->notFoundError("Category Not Found For Update!");
            }
            
            $imageName = $category_data->category_image;
            if ($request->hasFile("category_image")) {
                if (!empty($category_data->category_image)) {
                    $this->destroyImage($category_data->category_image, "picture/category_image");
                }
                $imageName = $this->storeImage($request->category_image, "picture/category_image");
            }
            
            $data = [
                "category_name" => $request->category_name,
                "category_image" => $imageName,
                "category_details" => $request->category_details,
                "updated_at" => now()
            ];
            
            DB::table("categories")->where("id", $id)->update($data);
            DB::commit();
            Log::info("Category Successfully Updated For Id: {$id}");
            return $this->success("Category Successfully Updated!");
        }
        catch(\Illuminate\Validation\ValidationException $e) {
            DB::rollback();
            Log::error("Validation Error At Update Category!");
            return $this->validationError($e, 'Please provide valid input.');
        }
        catch(\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return $this->genericError($e, "Category Update Unsuccessful!");
        }
    }
// Update Category End


// Destroy Category Start
    public function destroyCategory($id)
    {
        try{
            DB::beginTransaction();
            $data = DB::table("categories")->where("id", $id)->first();
            if (empty($data)) {
                Log::info("Category Not Found For Delete At Id:${id}");
                return $this->notFoundError('Category Not Found For Delete!');
            }
             if(empty($data->category_image)){
             Log::info("Category Don't Have Image For Id:{$id}");
             } else {
             $this->destroyImage($data->category_image, 'picture/category_image');
             Log::info("Image deleted for Category ID: {$id}");
             }
            DB::table("categories")->where("id", $id)->delete();
            DB::commit();
            Log::info("Category Successfuly Deleted For Id:{$id}");
            return $this->success("Category Successfully Deleted!");
        }
        catch(\Exception $e){
            DB::rollBack();
            Log::error("Error in destroyCategory: " . $e->getMessage());
            return $this->genericError($e,"Under Maintenance.Please try again later or contact your service provider.");
        }

    }
//  Destroy Category End

}

