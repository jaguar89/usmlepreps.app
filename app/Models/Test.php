<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function system(){
        return $this->belongsTo(System::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('solved', 'completed')->withTimestamps();
    }


}
