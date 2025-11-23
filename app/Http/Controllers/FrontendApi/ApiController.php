<?php
namespace App\Http\Controllers\FrontendApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Service;
use App\Models\Review;



class ApiController extends Controller{

    public function getCategory()
    {
        $data = Category::all()->map(function ($category) {
            $category->category_image = asset('picture/category_image/' . $category->category_image);
            return $category;
        });

        return response()->json($data);
    }

   

    public function getService()
    {
    $data = DB::table('services')
        ->leftJoin('categories', 'services.category_id', '=', 'categories.id')
        ->select(
            'services.*',            
            'categories.category_name' 
        )
        ->get()
        ->map(function ($service) {
            $service->service_image = asset('picture/service_image/' . $service->service_image);
            return $service;
        });

      return response()->json($data);
    }

    public function getReview(){
        $data=Review::all()->map(function($review){
            $review->image=asset('picture/review_image/' . $review->image);
            return $review;
        });
        return response()->json($data);
    }



}
