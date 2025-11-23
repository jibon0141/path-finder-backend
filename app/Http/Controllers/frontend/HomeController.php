<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class HomeController extends Controller{
	public function loginPage(){
		return View("admin.extends.admin.admin_login");
	}
	public function login(Request $request){
		
		$request->validate([
			"email"=>"required",
			"password"=>"required",
		]);
		$select_admin = DB::table("admins")->where("email", "=", $request->email)->first();
		if($select_admin==null){
			
		return redirect("/login-page");
		}
		elseif($select_admin->status == "approved"){
			
				$credential=[
                "email"=>$request->input("email"),
				"password"=>$request->input("password"),
				];
				$remember = $request->has('remember') ? true : false;
			if(Auth::guard('admins')->attempt($credential, $remember)){
				return redirect("/admin/dashboard");
			}
			else{
				return redirect("/login-page");
		
			}
			
			
		}
		else{
			return redirect("/login-page");
		}
	}



	public function logout(){

		 $admin = Auth::guard('admins')->user();

    if ($admin) {
        $admin->update(['remember_token' => null]); 
    }
		Auth::guard("admins")->logout();
		 return redirect('/login-page');
	}
	
	
}