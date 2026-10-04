<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class HomeController extends Controller
{
	public function loginPage()
	{
		if (Auth::guard('admins')->check()) {
			return redirect('/admin/dashboard');
		}
		return view("admin.extends.admin.admin_login");
	}

	public function login(Request $request)
	{
		$request->validate([
			"email" => "required|email",
			"password" => "required",
		]);

		$select_admin = DB::table("admins")->where("email", "=", $request->email)->first();
		if (!$select_admin) {
			return redirect("/login-page")
				->withErrors(['email' => 'These credentials do not match our records.'])
				->withInput($request->only('email'));
		}

		if ($select_admin->status == "approved" || $select_admin->status == "1") {
			$credential = [
				"email" => $request->input("email"),
				"password" => $request->input("password"),
			];
			$remember = $request->has('remember') ? true : false;
			if (Auth::guard('admins')->attempt($credential, $remember)) {
				$request->session()->regenerate();
				return redirect()->intended("/admin/dashboard");
			} else {
				return redirect("/login-page")
					->withErrors(['password' => 'The provided password does not match our records.'])
					->withInput($request->only('email'));
			}
		} elseif ($select_admin->status == "pending" || $select_admin->status == "0") {
			return redirect("/login-page")
				->withErrors(['email' => 'Your account is pending approval.'])
				->withInput($request->only('email'));
		} else {
			return redirect("/login-page")
				->withErrors(['email' => 'Your account is inactive or banned.'])
				->withInput($request->only('email'));
		}
	}

	public function logout(Request $request)
	{
		$admin = Auth::guard('admins')->user();
		if ($admin) {
			$admin->update(['remember_token' => null]);
		}
		Auth::guard("admins")->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/login-page')->with('success', 'Logged out successfully.');
	}
}