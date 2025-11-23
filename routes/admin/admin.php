<?php
// use App\Http\Controllers\backend\dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'dashboard'], function(){

// Route::get("/dashboard","DashboardController@dashboard")->name("dashboard");

});

Route::group(["namespace"=>"Admin"],function(){

	Route::get("/admin/admin-registration-page","AdminManagementController@adminRegistrationPage")->name("admin-registration-page");
	Route::post("/admin/store-admin","AdminManagementController@storeAdmin")->name("store-admin");

    Route::get("/admin/admin-profile","ManageProfileController@profile")->name("admin-profile");
	Route::put("/admin/update-profile","ManageProfileController@updateProfile")->name("update-profile");
    Route::put("/admin/update-admin-password","ManageProfileController@updatePassword")->name("update-admin-password");
	Route::put("/admin/update-profile-picture","ManageProfileController@upadateProfilePicture")->name("update-profile-picture");
});

Route::group(["namespace"=>"Category"],function(){
    Route::get("/manage-category","CategoryController@manageCategory")->name("manage-category");
    Route::match(["get","post"],"/store-category","CategoryController@storeCategory")->name("store-category");
    Route::get("/edit-category/{id}","CategoryController@editCategory")->name("edit-category");
    Route::put("/update-category/{id}","CategoryController@updateCategory")->name("update-category");
    Route::delete("/delete-category/{id}","CategoryController@destroyCategory")->name("delete-category");
});

Route::group(["namespace"=>"Service"],function(){
    Route::get("/manage-service","ServiceController@manageService")->name("manage-service");
    Route::match(["get", "post"], "/store-service", "ServiceController@storeService")->name("store-service");
    Route::get("/show-service/{id}", "ServiceController@showService")->name("show-service");
    Route::get("/edit-service/{id}", "ServiceController@editService")->name("edit-service");
    Route::put("/update-service/{id}", "ServiceController@updateService")->name("update-service");
    Route::delete("/delete-service/{id}", "ServiceController@destroyService")->name("delete-service");
});

Route::group(["namespace"=>"Review"],function(){
    Route::get("/manage-review","ReviewController@manageReview")->name("manage-review");
    Route::match(["get","post"],"/store-review","ReviewController@storeReview")->name("store-review");
    Route::get("/show-review/{id}","ReviewController@showReview")->name("show-review");
    Route::get("/edit-review/{id}","ReviewController@editReview")->name("edit-review");
    Route::put("/update-review/{id}","ReviewController@updateReview")->name("update-review");
    Route::delete("/delete-review/{id}","ReviewController@destroyReview")->name("delete-review");
});

Route::group(["namespace"=>"Setting"],function(){
    Route::get("/manage-setting","SettingController@manageSetting")->name("manage-setting");
    Route::put("/update-setting","SettingController@updateSetting")->name("update-setting");
    Route::get("/system-optimization","SettingController@systemOptimization")->name("system-optimization");
    Route::post("/clear-cache","SettingController@clearCache")->name("clear-cache");
    Route::post("/clear-config","SettingController@clearConfig")->name("clear-config");
    Route::post("/clear-view","SettingController@clearView")->name("clear-view");
    Route::post("/clear-route","SettingController@clearRoute")->name("clear-route");
    Route::post("/optimize-app","SettingController@optimizeApp")->name("optimize-app");
    Route::get("/manage-logs","SettingController@manageLogs")->name("manage-logs");
    Route::get("/view-log/{fileName}","SettingController@viewLogContent")->name("view-log");
});


