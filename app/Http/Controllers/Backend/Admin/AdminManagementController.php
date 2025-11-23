<?php
namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Auth;
use Hash;
use App\Traits\ManageImage;
use App\Traits\HandeLErrorSuccess;
use Carbon\Carbon;
use App\Models\Admin;



class AdminManagementController extends Controller
{
    use ManageImage,HandeLErrorSuccess; 

    public function adminRegistrationPage()
    {
        return view("admin.extends.admin.admin_registration");
    }

    public function storeAdmin(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                "name" => "required",
                "email" => "required|unique:admins,email",
                "password" => "required|string|min:6",
                "mobile_number" => "required",
                "picture" => "required",
            ]);

            $imageName= $this->storeImage($request->picture,'picture/admin_image');

            $data = [
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "mobile_number" => $request->mobile_number,
                "picture" => $imageName,
                "status" => "pending"

            ];
            DB::table("admins")->insert($data);
            DB::commit();
            Log::info('Admin Successfully Added!');
            return $this->success('Admin Successfully Added!');
           
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation Error:' .  $e->errors());
            return $this->validationError($e,'Plaease Provide  Valid Input!');
           
    }
    catch(\Exception $e){
        DB::rollBack();
        Log::error('Generic Error: '. $e->getMessage());
        return $this->genericError($e,'Admin Add Unsuccessful!');

    }
    }

}