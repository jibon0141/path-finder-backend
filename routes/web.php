 <?php
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('admin.extends.admin.admin_login');
});

Route::get("/admin/dashboard","DashboardController@Dashboard")->name("dashboard")->middleware("AdminMiddleware");

Route::get("/login-page",[HomeController::class,"loginPage"])->name("login-page");
Route::post("/login",[HomeController::class,"login"])->name("login");
Route::post("/logout",[HomeController::class,"logout"])->name("logout");



 Route::get('/send-mail', function () {
     Mail::send('emails.sample', [], function ($message) {
         $message->to('test@example.com')
             ->subject('Invoice with Attachment')
             ->attach(public_path('picture/abid.pdf')); // file path
     });

     return 'Mail sent successfully';
 });








