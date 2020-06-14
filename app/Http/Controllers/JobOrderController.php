<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Joborder;
use App\Joborder_seq;
use App\Jobstatus;
use App\Jobtype;
use App\Department;
use App\Branch;
use App\Location;
use App\Priority;
use App\Employee;
use App\Requester;
use App\Material;
use App\User;
use App\Jobmateriallist;
use App\Ma_approved;
use Auth;
use App\Log;
use DB;
use Redirect,Response;
use App\Traits;
use DateTime;
use DataTables;
use Carbon\Carbon;
use PDF;

class JobOrderController extends Controller
{
    use Traits; // for Save logs
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whereBranch = $this->getBranchId();
        $stmt4 = Department::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        return view('joborder.index',[
            'data4' => $stmt4,
            'data5' => $stmt5,
            ]);
    }
    public function getdata(Request $request)
    {
        
        $whereBranch = $this->getBranchId();
        return Datatables::of(Joborder::query()
        ->select('joborders.*', 'jobstatuses.name as js_name',
                 'jobtypes.name as jt_name','employees.f_name','employees.l_name',
                 'branches.short_name as b_name','priorities.name as p_name','priorities.color_code as color_name')
        ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        // ->leftjoin('employees', 'joborders.created_by', '=', 'employees.id')
        // ->leftjoin('employees', 'users.emp_id', '=', 'employees.id')
        ->join('users','joborders.assign_as','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        ->Rightjoin('priorities', 'joborders.priority_id', '=', 'priorities.id')
        ->whereRaw('branches.id = '. $whereBranch)
        ->where('joborders.trash', 0)
        ->whereBetween('joborders.job_date', [
            $request->get('startDate').' 00:00:00',
            $request->get('endDate').' 23:59:59',
        ])
        ->get())->make(true);
            // dd();
    }

    public function searchResult($querystring)
    {
        // dd($querystring);
        
        return view('joborder.searchresult');
        
        //
    }

    public function print_frm01($id)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Joborder::query()
        ->select('joborders.*', 'jobstatuses.name as js_name',
        'jobtypes.name as jt_name',
        'branches.short_name as b_name','priorities.color_code as p_name','employees.f_name','employees.l_name')
        ->join('users','joborders.assign_as','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        ->Join('priorities', 'joborders.priority_id', '=', 'priorities.id')
        ->where('joborders.trash', 0)
        ->where('joborders.id', $id)
        ->get()->first();
        // dd($stmt);
        $stmt2 = Jobstatus::all()->where('trash', 0);
        $stmt3 = Jobtype::all()->where('trash', 0);
        $stmt4 = Department::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt6 = Priority::all()->where('trash', 0);
        $stmt7 = Employee::all()->where('trash', 0);
        $stmt8 = Jobmateriallist::query()
        ->select('jobmateriallists.*','materials.name as m_name','material_types.name as mt_name','materials.m_no','materialgroups.name as mg_name', 'm__stocks.qty_balance as qty_balance_as')
        ->Join('materials','jobmateriallists.m_id','=','materials.id')   
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->leftJoin('m__stocks','materials.id','=','m__stocks.m_id') 
        ->where('jobmateriallists.job_id',$id)
        ->get();
        $data = [  'data' => $stmt,
        'data2' => $stmt2,
        'data3' => $stmt3,
        'data4' => $stmt4,
        'data5' => $stmt5,
        'data6' => $stmt6,
        'data7' => $stmt7,
        'data8' => $stmt8];
        // dd($stmt);
        
        $pdf = PDF::loadView('report.form.frm01-form',$data);
        return $pdf->stream('ใบสั่งงาน-1.pdf');   
    }


    public function getlocation(Request $request)
    {
        
        // $whereBranch = $this->getBranchId();
        $stmt = Location::all()
        // ->whereRaw('branches.id = '. $whereBranch)
        ->where('trash', 0);
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>ชื่อสถานที่</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->name.'</td>
                    <td class="text-center"><a  data-value="'.$row->name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formLocation';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลสถานที่',
        ];
    }
    public function getrequest_by(Request $request)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Employee::query()
        ->select('employees.*','employees.id as emp_id' , 'branches.short_name as branch_name','departments.name_th as dep_name')
        ->Join('branches', 'employees.branch_id', '=', 'branches.id')
        ->Join('departments', 'employees.dep_id', '=', 'departments.id')
        ->whereRaw('branches.id ='. $request->get('branch_id'))
        ->where('employees.trash', 0)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>สาขา</th>
                    <th>ชื่อพนักงาน</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td>'.$row->f_name.'</td>
                    <td class="text-center"><a  data-id="'.$row->emp_id.'"data-value="'.$row->f_name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formRequest_by';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลผู้แจ้ง',
        ];
    }
    public function getassign_as(Request $request)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Employee::query()
        ->select('employees.*','employees.id as emp_id' , 'branches.short_name as branch_name','departments.name_th as dep_name')
        ->Join('branches', 'employees.branch_id', '=', 'branches.id')
        ->Join('departments', 'employees.dep_id', '=', 'departments.id')
        ->whereRaw('branches.id ='. $request->get('branch_id'))
        ->where('employees.trash', 0)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>สาขา</th>
                    <th>แผนก</th>
                    <th>ชื่อผู้ได้รับมอบหมาย</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td>'.$row->dep_name.'</td>
                    <td>'.$row->f_name.'</td>
                    <td class="text-center"><a  data-id="'.$row->emp_id.'" data-value="'.$row->f_name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formAssign_as';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลผู้ได้รับมอบหมาย',
        ];
    }
    public function getassignee(Request $request)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Employee::query()
        ->select('employees.*','employees.id as emp_id','branches.short_name as branch_name','departments.name_th as dep_name')
        ->Join('branches', 'employees.branch_id', '=', 'branches.id')
        ->Join('departments', 'employees.dep_id', '=', 'departments.id')
        ->whereRaw('branches.id = '. $request->get('branch_id'))
        ->where('employees.assign_flg', 1)
        ->where('employees.trash', 0)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>สาขา</th>
                    <th>แผนก</th>
                    <th>ชื่อผู้มอบหมาย</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td>'.$row->dep_name.'</td>
                    <td>'.$row->f_name.'</td>
                    <td class="text-center"><a  data-id="'.$row->emp_id.'" data-value="'.$row->f_name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formAssignee';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลผู้มอบหมาย',
        ];
    }
    public function getmaterial(Request $request)
    {
        
        $whereBranch = $this->getBranchId();
        $stmt = Material::query()
        ->select('materials.*', 'branches.short_name as branch_name','materialgroups.name as m_g_name',
                'materials.id as material_id',
                DB::raw("IFNULL(m__stocks.qty_balance,0) as qty_balance"),
                'material_types.name as m_t_name')
        ->Join('branches', 'materials.branch_id', '=', 'branches.id')
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->leftJoin('m__stocks', 'materials.id', '=', 'm__stocks.m_id')
        ->whereRaw('branches.id = '. $request->get('branch_id'))
        ->where('materials.trash', 0)
        ->where('materials.status', 1)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered small">
            <thead class="bg-primary text-white">
                <tr  class="text-center">
                    <th>หน่วยงาน</th>
                    <th>Material No</th>
                    <th>ประเภท</th>
                    <th>ชนิด</th>
                    <th>ชื่อวัสดุอุปกรณ์</th>
                    <th>Stock Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td class="text-center">'.$row->m_no.'</td>
                    <td class="text-center">'.$row->m_g_name.'</td>
                    <td class="text-center">'.$row->m_t_name.'</td>
                    <td>'.$row->name.'</td>
                    <td class="text-center">'.$row->qty_balance.'</td>
                    <td class="text-center"><a data-id="'.$row->material_id.'" data-value="'.$row->name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formMaterial';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลวัสดุอุปกรณ์',
        ];
    }
    public function getasset(Request $request)
    {
        
        $whereBranch = $this->getBranchId();
        $stmt = Asset::query()
        ->select('assets.*', 'branches.short_name as branch_name',
                             'assetmodels.name_th as a_name',
                             'departments.name_th as d_name',
                             'checkinstatuses.name as c_name')
        ->Join('assetmodels', 'assets.a_m_id', '=', 'assetmodels.id')
        ->Join('departments', 'assets.owner_dep', '=', 'departments.id')
        ->Join('checkinstatuses', 'assets.asset_status', '=', 'checkinstatuses.id')
        ->Join('branches', 'assets.branch_id', '=', 'branches.id')
        ->whereRaw('branches.id = '. $request->get('branch_id'))
        ->where('assets.trash', 0)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>สาขา</th>
                    <th>เจ้าของทรัพย์สิน</th>
                    <th>สถานะทรัพย์สิน</th>
                    <th>รหัสทรัพย์สิน</th>
                    <th>โมเดลทรัพย์สิน</th>
                    <th>เลขซีเรียล</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td class="text-center">'.$row->d_name.'</td>
                    <td>'.$row->c_name.'</td>
                    <td class="text-center">'.$row->asset_no.'</td>
                    <td class="text-center">'.$row->a_name.'</td>
                    <td class="text-center">'.$row->serial_no.'</td>
                    <td class="text-center"><button data-id="'.$row->asset_no.'" data-value="'.$row->name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formAsset';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลทรัพย์สิน',
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $whereBranch = $this->getBranchId();
        $stmt2 = Jobstatus::all()->where('trash', 0);
        $stmt3 = Jobtype::all()->where('trash', 0);
        // $stmt4 = Department::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt6 = Priority::all()->where('trash', 0);
        // $stmt7 = Employee::all()->where('trash', 0);
        return view('joborder.create',[
            // 'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            // 'data4' => $stmt4,
            'data5' => $stmt5,
            'data6' => $stmt6,
            // 'data7' => $stmt7,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $user_create = Auth::user() ? Auth::user()->email : 'USER_NULL';
        $user_id = Auth::user() ? Auth::user()->id : 'USER_NULL';
        try{
            // $request_date = DateTime::createFromFormat('d/m/Y', $request->get('request_date'));
            // $request_date = date("Y-m-d", strtotime($request_date->format('Y-m-d') . '- 543 years'));
            $job_date = Carbon::now();
            // $schedule_start_date = DateTime::createFromFormat('d/m/Y', $request->get('schedule_start_date'));
            // $schedule_start_date = date("Y-m-d", strtotime($schedule_start_date->format('Y-m-d') . '- 543 years'));
            // $schedule_end_date = DateTime::createFromFormat('d/m/Y', $request->get('schedule_end_date'));
            // $schedule_end_date = date("Y-m-d", strtotime($schedule_end_date->format('Y-m-d') . '- 543 years'));
            $jobtype_no = Jobtype::where('id', $request->get('job_type_id'))->first();
            $as_is =   Joborder_seq::where('job_type', $jobtype_no->job_no)->count();
            $as_is +=1;
            // dd($request);
            $stmt = new Joborder_seq([
                'job_type' => $jobtype_no->job_no,
                'as_is' => $as_is,
            ]);
            $stmt -> save();
            $prefix_date =  date("ym", strtotime(date('Y-m-d') . '+ 543 years'));
            $new_job_no = $jobtype_no->job_no.$prefix_date.'-'.sprintf("%04d", $as_is);
            $stmt = new Joborder(
            [  
                'job_no' => $new_job_no,
                'job_title' => $request->get('job_title'),
                'ma_no' => $request->get('ma_no'),
                'ma_type' => $request->get('ma_type'),
                'recommend' => $request->get('recommend'),
                'job_date' => $job_date,
                'request_by' => $request->get('request_by_text'),
                'ma_desc' => $request->get('ma_desc'),
                'asset_owner_dep_id' => $request->get('asset_owner_dep_id'),
                'location_name' => $request->get('location_name'),
                'assign_as' => $user_id,
                'request_tel' => $request->get('request_tel'),
                'request_dep' => $request->get('request_dep'),
                'request_sub_dep' => $request->get('request_sub_dep'),
                'asset_send' => $request->get('asset_send'),
                'asset_brand' => $request->get('asset_brand'),
                'asset_model' => $request->get('asset_model'),
                'asset_serial' => $request->get('asset_serial'),
                'asset_no' => $request->get('asset_no'),
                'asset_desc' => $request->get('asset_desc'),
                'job_type_id' => $request->get('job_type_id'),
                'branch_id' => $request->get('branch_id'),
                'job_status_id' => $request->get('job_status_id'),
                'priority_id' => $request->get('priority_id'),
                'created_by' => $user_create,
                'joborder_status' => 'new',
                'trash' => 0,
            ]);
            //  
            $stmt -> save();
            $lastid = $stmt->id;
            $logtxt = " สร้าง ใบซ่อมบำรุง ชื่องาน: ". $request->get('job_title') . " ";
            $logtxt .= " เลขใบแจ้งซ่อม: ".  $request->get('ma_no'). " ";
            $logtxt .= " สถานะใบงาน : ".  $request->get('job_status_id'). " ";
            $logtxt .= " ประเภทงาน : ".  $request->get('job_type_id'). " ";
            $logtxt .= " ความสำคัญ : ".  $request->get('priority_id'). " ";
            $logtxt .= " ผู้แจ้ง : ".  $request->get('request_by_text'). " ";
            //  ----------- Stock Transaction ----------
            if($request->get('stock_transaction')):
                $i = 0;
                foreach ($request->get('m_id') as $row) :
                    $stmt_detail = new Jobmateriallist(
                        [  
                            'job_id' => $lastid,
                            'm_id' => $request->get('m_id')[$i],
                            'reason' => $request->get('reason')[$i],
                            'qty_out' => $request->get('qty_out')[$i],
                            'qty_in' => $request->get('qty_in')[$i],
                            'stock_balance_as' => $request->get('stock_balance_as')[$i],
                            'm_flag' => $request->get('m_flag')[$i],                
                        ]);
                        // dd($stmt_detail);
                        $stmt_detail -> save();
                $i++;
                endforeach;
            endif;
            //  ----------- Stock Transaction ----------
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            $job_id = $lastid;
            $job_process = "joborder";
            $this->saveLogAdvance( 'OK', __FUNCTION__, app('request')->route()->getAction(), $logtxt ,$job_id,$job_process);
            return redirect('/joborder/'.$lastid.'/edit')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {         
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/jobordercreate')->with('error', $e->getMessage());
                // $e->getMessage();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        // $stmt = Joborder::query()
        // ->select('joborders.*', 'jobstatuses.name as js_name',
        // 'jobtypes.name as jt_name', 'departments.name_th as dep_name', 
        // 'branches.short_name as b_name','priorities.name as p_name',
        // 'employees.f_name as e_name','requesters.name as requester_name' )
        // ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        // ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        // ->Join('departments', 'joborders.request_dep_id', '=', 'departments.id')
        // ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        // ->Join('priorities', 'joborders.priority_id', '=', 'priorities.id')
        // ->Join('employees', 'joborders.assignee','=', 'employees.id')
        // ->Join('requesters', 'joborders.request_by','=', 'requesters.id')
        // ->where('joborders.trash', 0)
        // ->where('joborders.id', $id)
        // ->get()->first();
        $whereBranch = $this->getBranchId();
        $stmt = Joborder::query()
        ->select('joborders.*', 'jobstatuses.name as js_name',
        'jobtypes.name as jt_name',
        'branches.short_name as b_name','priorities.color_code as p_name','employees.f_name','employees.l_name')


        // DB::Raw("(SELECT employees.f_name as assignee_name FROM joborders
        // JOIN employees ON joborders.assignee = employees.id
        // WHERE joborders.id =  ".$id.") AS assignee_name,
        // (SELECT f_name as assignAs_name FROM joborders 
        // JOIN employees ON joborders.assign_as = employees.id
        // WHERE joborders.id = ".$id.") AS assignAs_name
        // ")

        ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        ->Join('priorities', 'joborders.priority_id', '=', 'priorities.id')
        ->join('users','joborders.assign_as','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->where('joborders.trash', 0)
        ->where('joborders.id', $id)
        ->get()->first();
        // dd($stmt);
        $stmt2 = Jobstatus::all()->where('trash', 0);
        $stmt3 = Jobtype::all()->where('trash', 0);
        // $stmt4 = Department::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt6 = Priority::all()->where('trash', 0);
        $stmt7 = Employee::all()->where('trash', 0);
        $stmt8 = Jobmateriallist::query()
        ->select('jobmateriallists.*','materials.name as m_name','material_types.name as mt_name','materials.m_no','materialgroups.name as mg_name', 'm__stocks.qty_balance as qty_balance_as')
        ->Join('materials','jobmateriallists.m_id','=','materials.id')   
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->leftJoin('m__stocks','materials.id','=','m__stocks.m_id') 
        ->where('jobmateriallists.job_id',$id)
        ->get();
        $stmt_log = DB::table('logs')
        ->where('job_id',$id)
        ->where('job_process','joborder')->orderBy('created_at', 'desc')->get();
        // dd($stmt_log);  
        return view('joborder.edit',[
            'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            // 'data4' => $stmt4,
            'data5' => $stmt5,
            'data6' => $stmt6,
            'data7' => $stmt7,
            'data8' => $stmt8,
            'data_log' => $stmt_log,
            ]);
    //  dd($stmt);
        try{
            $where = array('id' => $id);
            $stmt  = Joborder::where($where)->first();
            // dd($stmt);
            return Response::json($stmt);
            }catch (\Exception $e) {
                return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_create = Auth::user() ? Auth::user()->email : 'USER_NULL';
        $user_id = Auth::user() ? Auth::user()->id : 'USER_NULL';
        try{

            $stmt = Joborder::findOrFail($id);
            $flg = "";
            $job_flg = $request->get('job_flg');
            $stmt->job_title = $request->get('job_title');
            $stmt->ma_no = $request->get('ma_no');
            $stmt->location_name = $request->get('location_name');
            $stmt->ma_type = $request->get('ma_type');
            $stmt->ma_desc = $request->get('ma_desc');
            $stmt->recommend = $request->get('recommend');
            $stmt->request_by = $request->get('request_by_text');
            $stmt->request_dep = $request->get('request_dep');
            $stmt->assign_as = $request->get('assign_as');
            $stmt->request_tel = $request->get('request_tel');
            $stmt->request_sub_dep = $request->get('request_sub_dep');
            $stmt->asset_send = $request->get('asset_send');
            $stmt->asset_brand = $request->get('asset_brand');
            $stmt->asset_model = $request->get('asset_model');
            $stmt->asset_serial = $request->get('asset_serial');
            $stmt->asset_no = $request->get('asset_no');
            $stmt->asset_desc = $request->get('asset_desc');
            $stmt->job_status_id = $request->get('job_status_id');
            $stmt->created_by = $user_create;
            $stmt->priority_id = $request->get('priority_id');
            $stmt->joborder_status = '';
            $stmt->save();
            // dd($stmt);
            $job_id = $id;
            $job_process = "joborder";
            //  ----------- Stock Transaction ----------
            if($request->get('stock_transaction')):
                $i = 0;
          
                foreach ($request->get('m_id') as $row) :
                    $qty_in = $request->get('qty_in')[$i];
                    $qty_out = $request->get('qty_out')[$i];
                    $m_id = $request->get('m_id')[$i];
                    $m_no = $request->get('m_no')[$i];
                    $reason = $request->get('reason')[$i];
                    $stock_balance_as = $request->get('stock_balance_as')[$i];
                    $m_flag = $request->get('m_flag')[$i];     
                    // For save log
                
                    if ($job_flg == 'confirm' && $flg != "update" &&  $m_flag == "confirmout"):
                        $m_flag = "confirmin"; 
                        $operator = "+";
                        $result = $this->StockTransaction($m_id, $qty_in , $operator);          
                        // Save log stock
                        $logtxt = "ยืนยันการรับเข้า - รหัส Material No " . $m_no . " จำนวนเบิกออก:" .  $qty_out . " จำนวนรับเข้า:" . $qty_in . " คงเหลือปัจจุบัน:" .$stock_balance_as;
                        // $this->saveLogAdvance( 'OK', __FUNCTION__, app('request')->route()->getAction(), $logtxt ,$job_id,$job_process);
                         // Save log stock
                    endif;  
                    if ($job_flg == 'confirm' && $flg != "update"&& $m_flag == 'waitout'):
                        $m_flag = "confirmout";
                        $operator = '-';
                        $result = $this->StockTransaction($m_id, $qty_out , $operator);    
                           // Save log stock
                           $logtxt = "ยืนยันการเบิกออก - รหัส Material No" . $m_no . " จำนวนเบิกออก:" .  $qty_out . " จำนวนรับเข้า:" . $qty_in . " คงเหลือปัจจุบัน:" .$stock_balance_as;
                        //    $this->saveLogAdvance( 'OK', __FUNCTION__, app('request')->route()->getAction(), $logtxt ,$job_id,$job_process);
                            // Save log stock 
                    endif;
                        $stock_balance_as = ($stock_balance_as - $qty_out) + $qty_in;
                        $stmt_detail = Jobmateriallist::updateOrCreate(
                                ['id' => $request->get('_id')[$i]],
                                [
                                    'job_id' => $id,
                                    'm_id' => $m_id,
                                    'qty_out' => $qty_out,
                                    'qty_in' => $qty_in,
                                    'reason' => $reason,
                                    'm_flag' => $m_flag,
                                    'stock_balance_as' => $stock_balance_as,
                                ]);
                                // dd($stmt_detail);
                        $stmt_detail -> save();
                        if ($job_flg == 'confirm' && $flg != "update" && $m_flag == 'waitout'):
                                       
                        endif;
                        if ($job_flg == 'confirm' && $flg != "update" &&  $m_flag == "confirmout"):
                    
                        endif;
                        $i++;
                        
                endforeach;    
            endif;
            //  ----------- Stock Transaction ----------
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            //----- Log desc ----
            $logtxt = " ปรับปรุงใบซ่อมบำรุง ชื่องาน: ". $request->get('job_title') . " ";
            $logtxt .= " เลขใบแจ้งซ่อม: ".  $request->get('ma_no'). " ";
            $logtxt .= " สถานะใบงาน : ".  $request->get('job_status_id'). " ";
            $logtxt .= " ประเภทงาน : ".  $request->get('job_type_id'). " ";
            $logtxt .= " ความสำคัญ : ".  $request->get('priority_id'). " ";
            $logtxt .= " ผู้แจ้ง : ".  $request->get('request_by_text'). " ";
        //    $test =  $this->saveLogAdvance( 'OK', __FUNCTION__, app('request')->route()->getAction(), $logtxt ,$job_id,$job_process);
            return redirect('/joborder/'.$id.'/edit')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/joborder/'.$id.'/edit')->with('error', 'เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้');
                    // dd($e);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $stmt = Joborder::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'joborders','งานซ่อมบำรุง');
                return redirect('/joborder')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/joborder')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
    }
    public function deletedetail($id)
    {
        try{
            $stmt = Jobmateriallist::findOrFail($id);
            $stmt->delete();
             $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
                return "OK";
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return $e->getMessage();
            }
    }
    public function sendtoapproved($id)
    {
            // dd($id);
        $user_create = Auth::user() ? Auth::user()->email : 'USER_NULL';
        $user_id = Auth::user() ? Auth::user()->id : 'USER_NULL';
        try{
            $stmt = Joborder::findOrFail($id);
            $stmt->status_approved = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, ['as'=> 'update','controller'=>'jobordercontroller'], json_decode($stmt, true));
            $prefix_date =  date("Ym", strtotime(date('Y-m-d') . '+ 543 years'));
            $stmt = new Ma_approved(
            [  
                'job_id' => $id,
                'approved_by' => '',
                'approved_dep' => '',
                'ma_date' => $stmt->job_date,
                'created_by' => $user_id,
                'ap_ma_no' => $stmt->ma_no,
                'ap_request_by' => $stmt->request_by,
                'ap_request_tel' => $stmt->request_tel,
                'ap_request_dep' => $stmt->request_dep,
                'ap_request_sub_dep' => $stmt->request_sub_dep,
                'ap_asset_send' => $stmt->asset_send,
                'ap_asset_brand' => $stmt->asset_brand,
                'ap_asset_model' => $stmt->asset_model,
                'ap_asset_desc' => $stmt->job_title .'     '. $stmt->asset_desc,
                'ap_asset_no' => $stmt->asset_no,
                'ap_asset_serial' => $stmt->asset_serial,
                'ap_ma_type' => $stmt->ma_type,
                'ap_desc' =>  $stmt->ma_desc,
                'vendor_name' => $stmt->asset_send,
                'trash' => 0,
            ]);
            //  
            $stmt -> save();
            $lastid = $stmt->id;
            $this->saveLog( 'OK', __FUNCTION__, ['as'=> 'sendtoapproved','controller'=>'jobordercontroller'], json_decode($stmt, true));

            $job_id = $id;
            $job_process = "joborder";
            $logtxt = "ส่งอนุมัติซ่อมบำรุง";
            $test = $this->saveLogAdvance( 'OK', __FUNCTION__, ['as'=> 'sendtoapproved','controller'=>'jobordercontroller'], $logtxt ,$job_id,$job_process);
                return redirect('/joborder/'.$id.'/edit')->with('success', 'ส่งอนุมัติซ่อมบำรุงสำเร็จ');
             }catch (\Exception $e) {
                // dd($e);
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/joborder/'.$id.'/edit')->with('error', $e->getMessage());
            }         
    }
}
