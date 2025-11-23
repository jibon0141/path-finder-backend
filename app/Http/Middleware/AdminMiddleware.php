<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard("admins")->check()) {

            $adminId = Auth::guard('admins')->id(); 
            

            $data = DB::table('admins')->where('id', $adminId)->first();

            if (!$data) {
               Auth::guard('admins')->logout();
                return redirect('/login-page');
            }

            switch ($data->status) {
                case 'approved':
                    return $next($request);
                case 'pending':
                case 'banned':
                   Auth::guard('admins')->logout();
                    return redirect('/login-page');
                default:
                   Auth::guard('admins')->logout();
                    return redirect('/login-page');
            }
        }

        return redirect('/login-page'); 
    }
}
