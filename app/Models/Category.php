<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ManageImage;

class Category extends Model
{
    use HasFactory,ManageImage;

    protected $table="categories";
    protected $primaryKey="id";
    protected $hidden = [];
    protected $fillable=[
        "category_name",
        "category_image",
        "details",
        "status"
    ];
}
