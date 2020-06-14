<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ma_approved extends Model
{
    protected $fillable = [
        'job_id','approved_by','approved_dep','cost_ma','cost_c_no','cost_qty','vendor_name',
        'desc','approved_ma','ap_ma_no','ap_request_by','ap_request_tel','ap_request_dep',
        'ap_request_sub_dep','ap_asset_send','ap_asset_brand','ap_asset_model','ap_asset_desc',
        'ap_asset_no','ap_asset_serial','ap_ma_type','ap_desc','status','trash','ma_date','created_by'
    ];
}
