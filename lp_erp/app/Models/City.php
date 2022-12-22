<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{
    use HasRoles, HasFactory;

    protected $guarded = [];

    public function state(){
        return $this->belongsTo(State::class);
    }
}
