<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // link với factory để tạo fake data để test

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany(User::class) // n thuộc n với user
                    ->withPivot('title') // tương tự, tạo bảng pivot
                    ->withTimestamps();
    }
}
