<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'action',
        'module' ,
        'user' ,
        'page' ,
        'status' ,
        'desc' ,
        'trash_flag' ,
        'trash_table_name' ,
        'job_id' ,
        'job_process' ,
    ];
    //
}
