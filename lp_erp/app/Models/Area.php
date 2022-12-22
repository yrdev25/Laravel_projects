<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Area extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public function city(){
        return $this->belongsTo(City::class);
    }
}
