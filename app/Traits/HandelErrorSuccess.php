<?php
namespace App\Traits;
use App\Utility\ApiUtility;

trait HandelErrorSuccess
{
    public function success($message)
    {
        return response()->json([
            "status" => "success",
            "message" => $message,
            "code" => ApiUtility::Success_Code,
        ]);
    }

    public function validationError($e,$message)
    {
        return response()->json([
            "status" => "error",
            "message" => $message,
            "error" => $e->errors()
        ], ApiUtility::Validation_Error_Code);
    }

    public function genericError($e,$message)
    {
        return response()->json([
            "status" => "error",
            "message" => $message,
            "error" => $e->getMessage()
        ], ApiUtility::Generic_Error_Code);
    }

    public function notFoundError($message){
        return response()->json([
            "status"=>"error",
            "Message"=>$message,
        ],ApiUtility::Not_Found_Code);

    }

}
