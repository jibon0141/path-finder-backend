 <?php
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.extends.admin.admin_login');
});

Route::get("/admin/dashboard","DashboardController@Dashboard")->name("dashboard")->middleware("AdminMiddleware");

Route::get("/login-page",[HomeController::class,"loginPage"])->name("login-page");
Route::post("/login",[HomeController::class,"login"])->name("login");
Route::post("/logout",[HomeController::class,"logout"])->name("logout");







