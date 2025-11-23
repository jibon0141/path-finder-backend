<?php
namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class ManageProfileController extends Controller
{

    public function profile()
    {
        $profile = DB::table("admins")->where("id", "=", Auth::guard("admins")->user()->id)->first();
        return view("admin.extends.admin.admin_profile", compact("profile"));
    }

    public function upadateProfilePicture(Request $request)
    {
        try {
            $request->validate([
                'picture' => 'required|image',
            ]);
            $data = Auth::guard("admins")->user();
            $admin = new Admin();

            if ($request->hasFile('picture')) {
                $admin->destroyImage($data->picture, 'picture/admin_picture');
                $imageName = $admin->storeImage($request->picture, 'picture/admin_picture');
                $data->update([
                    'picture' => $imageName
                ]);
            }
            return response()->json([
                'status'=>'success',
                'message'=>'Picture Successfully Updated!',
                'code'=>200
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->errors()
            ],422);
        }

    }

    public function updateProfile(Request $request)
    {
        try {
            $data = DB::table("admins")->where("id", "=", Auth::guard('admins')->user()->id);
            $data->update([
                "name" => $request->name,
                "mobile_number" => $request->mobile_number,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Profile Successfully Updated!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "errors" => $e->errors()
            ], 422);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:6',
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6',
            ]);

            $data = Auth::guard("admins")->user();

            if (Hash::check($request->password, $data->password)) {
                $data->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password Successfully Updated!',
                    'code'=>200
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The current password is incorrect!',
                    'code'=>400
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }





}


