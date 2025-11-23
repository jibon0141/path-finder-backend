<?php
namespace App\Http\Controllers\backend\Review;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use App\Traits\ManageImage;
use App\Traits\HandelErrorSuccess;


class ReviewController extends Controller{

    use ManageImage,HandelErrorSuccess;

// Manage review Start Here
    public function manageReview()
    {
        if (request()->ajax()) {
            $query = DB::table('reviews')->get();
            return DataTables::of($query)
                ->addColumn('action', function ($data) {
                    $button = '<div>';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
                    $button .= '</div>';
                    
                    $button .= '<div style="margin-top: 5px;">';
                    $button .= '<button name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm confirmDelete" record="Review" recordid="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                    $button .= '</div>';
                    
                    return $button;
                })
                ->rawColumns(['action'])
                ->toJson();
        } else {
            return view("admin.extends.review.manage_review");
        }
    }
// Manage review End Here

// Store review Start Here
     public function storeReview(Request $request)
     {

         try{
             DB::beginTransaction();
             if($request->isMethod('POST')){
                 $request->validate([
                     'name'=>'required',
                     'image'=>'required',
                     'appreciation'=>'required',

                 ]);

                 $imageName=$this->storeImage($request->image, 'picture/review_image');

                 $data=[
                     'name'=>$request->name,
                     'image'=>$imageName,
                     'appreciation'=>$request->appreciation,
                     "created_at" => Carbon::now()

                 ];

                 DB::table('reviews')->insert($data);
                 DB::commit();
                 Log::info("Review Successfully Stored!");
                 return $this->success('Review Successfully Stored!');

             }
             return view('admin.extends.review.store_review');

         }
         catch(\Illuminate\Validation\ValidationException $e){
             DB::rollBack();
             Log::error("Validation Error In Store Review");
             return $this->validationError($e, 'Please provide valid input.');
         }
         catch(\Exception $e){
             DB::rollBack();
             Log::error($e->getMessage());
             return $this->genericError($e->getMessage(), 'Review Store Failed!');
         }

     }
//  Store review End Here



//  Show Review Start Here
public function showReview($id)
{

    try{
        $data=DB::table('reviews')->where('id',$id)->first();
        Log::info("Review data Successfully Fetched for id:{$id}");
        return $this->success('Review Successfully Fetched!');
    }
    catch(\Exception $e){
        Log::error($e->getMessage());
        return $this->genericError($e->getMessage(),'Review Fetched Unsuccessful!');
    }

}

//  Show Review End Here



// Edit Review Start Here
public function editReview($id)
{
    try{
        $data = DB::table('reviews')->where('id',$id)->first();
        if(empty($data)){
            Log::info("Review Not Found for ID: {$id}");
            return response()->json(['error' => 'Review not found'], 404);
        }
        Log::info("Review data Successfully Fetched for:{$id}");
        return response()->json([
            'review' => $data
        ]);
    }
    catch(\Exception $e){
        Log::error($e->getMessage());
        return response()->json(['error' => 'Review Fetch Failed'], 500);
    }
}
// Edit Review End Here



//  Update Review Start Here
public function updateReview(Request $request,$id)
{

         try{
             DB::beginTransaction();
                  $request->validate([
                      'name'=>'required',
                      'image'=>'nullable|image',
                      'appreciation'=>'required',
                  ]);
              $review_data=DB::table('reviews')->where('id',$id)->first();
              if(empty($review_data)){
                Log::info("Review Not Found For Update at Id: {$id}");
                return $this->notFoundError('Review Not Found For Update!');
              }

              $imageName = $review_data->image;
           if ($request->hasFile('image')) {
            if (!empty($review_data->image)) {
             $this->destroyImage($review_data->image, 'picture/review_image');
            }
           $imageName = $this->storeImage($request->image, 'picture/review_image');
}

             $data=[
                 'name'=>$request->name,
                 'image'=>$imageName,
                 'appreciation'=>$request->appreciation,
                 "updated_at" => Carbon::now()
             ];

             DB::table('reviews')->where('id',$id)->update($data);
             DB::commit();
             Log::info('Review Successfully Updated for Id:{$id}');
             return $this->success('Review Successfully Updated!');
         }
         catch(\Illuminate\Validation\ValidationException $e){
             DB::rollBack();
             Log::error("Validation Error in updateReview");
             return $this->validationError($e, 'Please provide valid input.');
         }
         catch(\Exception $e){
             DB::rollBack();
             Log::error($e->getMessage());
             return $this->genericError($e, 'Review Updated Unsuccessful!');
         }

}
// Update Review End Here



//  Delete Review Start Here
public function destroyReview($id)
{
    try{
        DB::beginTransaction();
       $review= DB::table('reviews')->where('id',$id)->first();
       if(empty($review)){
        Log::error('Review not Found For Delete!');
       return $this->notFoundError('Review Not Found for Delete!');
       }
       if(empty($review->image)){
         Log::info("Review Don't Have Image For Id:{$id}");
       } else {
            $this->destroyImage($review->image, 'picture/review_image');
            Log::info("Image deleted for review ID: {$id}");
        }
       DB::table('reviews')->where('id',$id)->delete();
       DB::commit();
       Log::info("Review Successfully Deleted for Id:{$id}");
       return $this->success('Review Successfully Deleted!');
    }
    catch(\Exception $e){
        DB::rollBack();
        Log::error($e->getMessage());
        return $this->genericError($e->getMessage(), 'Review Delete Failed!');

    }

}
//  Delete Review End Here


}


