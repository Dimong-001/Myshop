<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// app/Models/Category.php
class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'is_active'];
}
