<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'title' , 'thumbnail'];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('watched')->withTimestamps();
    }

}
