<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_type extends Model
{
    protected $fillable = [
       'name', 'desc', 'm_g_id', 'trash','code'
    ];
}
