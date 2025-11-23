<?php
namespace App\Http\Controllers\backend\Service;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use App\Traits\ManageImage;
use App\Traits\HandelErrorSuccess;


class ServiceController extends Controller{

    use ManageImage,HandelErrorSuccess;

// Manage service Start Here
    public function manageService()
    {
        if (request()->ajax()) {
            $query = DB::table('services')
                ->join('categories', 'services.category_id', '=', 'categories.id')
                ->select('services.*', 'categories.category_name')
                ->get();
            return DataTables::of($query)
                ->addColumn('action', function ($data) {
                    $button = '<div>';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
                    $button .= '</div>';
                    
                    $button .= '<div style="margin-top: 5px;">';
                    $button .= '<button name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm confirmDelete" record="Service" recordid="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                    $button .= '</div>';
                    
                    return $button;
                })
                ->rawColumns(['action'])
                ->toJson();
        } else {
            return view("admin.extends.service.manage_service");
        }
    }
// Manage service End Here

// Store service Start Here
     public function storeService(Request $request)
     {

         try{
             DB::beginTransaction();
             if($request->isMethod('POST')){
                 $request->validate([
                     'service_name'=>'required',
                     'service_image'=>'required',
                     'description'=>'required',
                     'category_id'=>'required',
                     'pricing'=>'required',
                     'duration'=>'required',
                     'counselor'=>'required',
                     'specialty'=>'required',
                     'rating'=>'required',
                     'reviews'=>'required',
                     'location'=>'required',
                     'capacity'=>'required',
                     'features'=>'required',

                 ]);

                 $imageName=$this->storeImage($request->service_image, 'picture/service_image');

                 $data=[
                     'service_name'=>$request->service_name,
                     'service_image'=>$imageName,
                     'description'=>$request->description,
                     'category_id'=>$request->category_id,
                     'pricing'=>$request->pricing,
                     'duration'=>$request->duration,
                     'counselor'=>$request->counselor,
                     'specialty'=>$request->specialty,
                     'rating'=>$request->rating,
                     'reviews'=>$request->reviews,
                     'location'=>$request->location,
                     'capacity'=>$request->capacity,
                     'features'=>json_encode($request->features),
                     "created_at" => Carbon::now()

                 ];

                 DB::table('services')->insert($data);
                 DB::commit();
                 Log::info("Service Successfully Stored!");
                 return $this->success('Service Successfully Stored!');

             }
             $category=DB::table('categories')->get();
             return view('admin.extends.service.store_service',compact('category'));

         }
         catch(\Illuminate\Validation\ValidationException $e){
             DB::rollBack();
             Log::error("Validation Error In Store Service");
             return $this->validationError($e, 'Please provide valid input.');
         }
         catch(\Exception $e){
             DB::rollBack();
             Log::error($e->getMessage());
             return $this->genericError($e->getMessage(), 'Service Store Failed!');
         }

     }
//  Store service End Here



//  Show Service Start Here
public function showService($id)
{

    try{
        $data=DB::table('services')->where('id',$id)->first();
        Log::info("Service data Successfully Fetched for id:{$id}");
        return $this->success('Service Successfully Fetched!');
    }
    catch(\Exception $e){
        Log::error($e->getMessage());
        return $this->genericError($e->getMessage(),'Service Fetched Unsuccessful!');
    }

}

//  Show Service End Here



// Edit Service Start Here
public function editService($id)
{
    try{
        $data = DB::table('services')->where('id',$id)->first();
        if(empty($data)){
            Log::info("Service Not Found for ID: {$id}");
            return response()->json(['error' => 'Service not found'], 404);
        }
        $categories = DB::table('categories')->get();
        Log::info("Service data Successfully Fetched for:{$id}");
        return response()->json([
            'service' => $data,
            'categories' => $categories
        ]);
    }
    catch(\Exception $e){
        Log::error($e->getMessage());
        return response()->json(['error' => 'Service Fetch Failed'], 500);
    }
}
// Edit Service End Here



//  Update Service Start Here
public function updateService(Request $request,$id)
{

         try{
             DB::beginTransaction();
                  $request->validate([
                      'service_name'=>'required',
                      'service_image'=>'nullable|image',
                      'description'=>'required',
                      'category_id'=>'required',
                      'pricing'=>'required',
                      'duration'=>'required',
                      'counselor'=>'required',
                      'specialty'=>'required',
                      'rating'=>'required|numeric|min:1|max:5',
                      'reviews'=>'required|numeric|min:0',
                      'location'=>'required',
                      'capacity'=>'required',
                      'features'=>'required',
                  ]);
              $service_data=DB::table('services')->where('id',$id)->first();
              if(empty($service_data)){
                Log::info("Service Not Found For Update at Id: {$id}");
                return $this->notFoundError('Service Not Found For Update!');
              }

              $imageName = $service_data->service_image;
           if ($request->hasFile('service_image')) {
            if (!empty($service_data->service_image)) {
             $this->destroyImage($service_data->service_image, 'picture/service_image');
            }
           $imageName = $this->storeImage($request->service_image, 'picture/service_image');
}

             $data=[
                 'service_name'=>$request->service_name,
                 'service_image'=>$imageName,
                 'description'=>$request->description,
                 'category_id'=>$request->category_id,
                 'pricing'=>$request->pricing,
                 'duration'=>$request->duration,
                 'counselor'=>$request->counselor,
                 'specialty'=>$request->specialty,
                 'rating'=>$request->rating,
                 'reviews'=>$request->reviews,
                 'location'=>$request->location,
                 'capacity'=>$request->capacity,
                 'features'=>json_encode(explode("\n", trim($request->features[0]))),
                 "updated_at" => Carbon::now()
             ];

             DB::table('services')->where('id',$id)->update($data);
             DB::commit();
             Log::info('Services Successfully Updated for Id:{$id}');
             return $this->success('Services Successfully Updated!');
         }
         catch(\Illuminate\Validation\ValidationException $e){
             DB::rollBack();
             Log::error("Validation Error in updateService");
             return $this->validationError($e, 'Please provide valid input.');
         }
         catch(\Exception $e){
             DB::rollBack();
             Log::error($e->getMessage());
             return $this->genericError($e, 'Services Updated Unsuccessful!');
         }

}
// Update Service End Here



//  Delete Service Start Here
public function destroyService($id)
{
    try{
        DB::beginTransaction();
       $service= DB::table('services')->where('id',$id)->first();
       if(empty($service)){
        Log::error('Service not Found For Delete!');
       return $this->notFoundError('Service Not Found for Delete!');
       }
       if(empty($service->service_image)){
         Log::info("Service Don't Have Image For Id:{$id}");
       } else {
            $this->destroyImage($service->service_image, 'picture/service_image');
            Log::info("Image deleted for service ID: {$id}");
        }
       DB::table('services')->where('id',$id)->delete();
       DB::commit();
       Log::info("Service Successfully Deleted for Id:{$id}");
       return $this->success('Service Successfully Deleted!');
    }
    catch(\Exception $e){
        DB::rollBack();
        Log::error($e->getMessage());
        return $this->genericError($e->getMessage(), 'Service Delete Failed!');

    }

}
//  Delete Service End Here


}
