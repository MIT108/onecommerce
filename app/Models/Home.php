<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Home extends Model
{
    use HasFactory;
    protected $fillable = ['heading', 'description', 'image', 'type'];
    public function getImageAttribute($value){
        return Storage::url("images/home/".$value);
    }
}
