<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joborder extends Model
{
    protected $fillable = [
        'job_no', 'job_title','ma_no', 'job_date', 'request_by', 'request_tel', 'request_dep', 'request_sub_dep',
        'asset_send','asset_brand','asset_model','asset_serial','asset_no','asset_desc','assign_as',
        'job_type_id','branch_id','job_status_id','created_by','priority_id','trash',
        'joborder_status', 'ma_type', 'ma_desc', 'recommend','status_approved','location_name'
    ];
}
