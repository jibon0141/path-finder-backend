<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ManageImage;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable,ManageImage;

    const default_name="Abid Hasan";
    const default_email="jibon0141@gmail.com";
    const default_mobile_number="01832265649";
    const default_picture="picture/admin_picture/1733574632_about.jpg";

    const default_admin=[
    	"name"=>self::default_name,
    	"email"=>self::default_email,
    	"mobile_number"=>self::default_mobile_number,
    	"picture"=>self::default_picture

    ];

    protected $table="admins";
    protected $primaryKey="id";
    protected $hidden=["deleted_at","remember_token","password"];
    protected $fillable=["name","email","mobile_number","picture","status","password"];


}
