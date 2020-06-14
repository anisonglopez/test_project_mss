<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ma_approved;
use App\Joborder;
use App\Department;
use App\Branch;
use App\Jobtype;
use App\Jobstatus;
use App\Priority;
use App\Employee;
use DB;
use Carbon\Carbon;
use Redirect,Response;
use App\Traits;
use DataTables;
use PDF;
class Ma_approvedController extends Controller
{
    use Traits;
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
        return view('ma_approved.index',[
            'data4' => $stmt4,
            'data5' => $stmt5,
            ]);
    }
    
    public function getdata(Request $request)
    {
        return Datatables::of(Ma_approved::query()
        ->select('joborders.*','ma_approveds.*' , 'branches.short_name as b_name' ,
        'jobtypes.name as jt_name','employees.f_name','employees.l_name', 'jobstatuses.name as js_name',
        'priorities.name as p_name','priorities.color_code as color_name')
        
        
        ->Join('joborders', 'ma_approveds.job_id', '=', 'joborders.id')
        ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        ->join('users','ma_approveds.created_by','=','users.id')
        ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        ->Rightjoin('priorities', 'joborders.priority_id', '=', 'priorities.id')
        ->where('joborders.trash', 0)
        ->where('ma_approveds.trash', 0)
        ->whereBetween('joborders.job_date', [
            $request->get('startDate').' 00:00:00',
            $request->get('endDate').' 23:59:59',
        ])
        ->get())->make(true);
        
        
            // dd();
    }
    public function print_frm02($id)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Ma_approved::query()
        ->select('ma_approveds.*','joborders.*','employees.f_name','employees.l_name')
        ->Join('joborders', 'ma_approveds.job_id', '=', 'joborders.id')
        ->join('users','ma_approveds.created_by','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->where('ma_approveds.id', $id)
        ->get()->first();
        
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
        $data = [  
        'data' => $stmt,
        'data2' => $stmt2,
        'data3' => $stmt3,
        'data4' => $stmt4,
        'data5' => $stmt5,
        'data6' => $stmt6,
        'data7' => $stmt7,];
        // dd($stmt);
        $pdf = PDF::loadView('report.form.frm02-form',$data);
        return $pdf->stream('ใบสั่งงาน-2.pdf');   
    }
    public function getapproved_by(Request $request)
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
        $frmAction =  'formApproved_by';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลผู้แจ้ง',
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
        $stmt4 = Department::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt6 = Priority::all()->where('trash', 0);
        $stmt7 = Employee::all()->where('trash', 0);
        return view('ma_approved.create',[
            // 'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            'data4' => $stmt4,
            'data5' => $stmt5,
            'data6' => $stmt6,
            'data7' => $stmt7,
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

            $prefix_date =  date("Ym", strtotime(date('Y-m-d') . '+ 543 years'));
            $stmt = new Ma_approved(
            [  
                'job_id' => $request->get('job_id'),
                'approved_by' => $request->get('approved_by_text'),
                'approved_dep' => $request->get('approved_dep'),
                'cost_ma' => $request->get('cost_ma'),
                'cost_c_no' => $request->get('cost_c_no'),
                'cost_qty' => $request->get('cost_qty'),
                'vendor_name' => $request->get('vendor_name'),
                'desc' => $request->get('desc'),
                'approved_ma' => $request->get('approved_ma'),
                'ap_ma_no' => $request->get('ap_ma_no'),
                'ap_request_by' => $request->get('ap_request_by'),
                'ap_request_tel' => $request->get('ap_request_tel'),
                'ap_request_dep' => $request->get('ap_request_dep'),
                'ap_request_sub_dep' => $request->get('ap_request_sub_dep'),
                'ap_asset_send' => $request->get('ap_asset_send'),
                'ap_asset_brand' => $request->get('ap_asset_brand'),
                'ap_asset_model' => $request->get('ap_asset_model'),
                'ap_asset_desc' => $request->get('ap_asset_desc'),
                'ap_asset_no' => $request->get('ap_asset_no'),
                'ap_asset_serial' => $request->get('ap_asset_serial'),
                'created_by' => $user_id,
                'ap_ma_type' => $request->get('ap_ma_type'),
                'ap_desc' => $request->get('ap_desc'),
                'trash' => 0,
            ]);
            //  
            $stmt -> save();
            $lastid = $stmt->id;
            // dd($stmt);
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/ma_approved/'.$lastid.'/edit')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {         
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/ma_approvedcreate')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
        $whereBranch = $this->getBranchId();
        // $stmt = Ma_approved::findOrFail($id);
        $stmt = Ma_approved::query()
        ->select('joborders.*','ma_approveds.*','employees.f_name','employees.l_name')
        ->Join('joborders', 'ma_approveds.job_id', '=', 'joborders.id')
        ->Join('users','ma_approveds.created_by','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->where('ma_approveds.id', $id)
        ->get()->first();

        $stmt2 = Jobstatus::all()->where('trash', 0);
        $stmt3 = Jobtype::all()->where('trash', 0);
        $stmt5 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt6 = Priority::all()->where('trash', 0);
        $stmt7 = Employee::all()->where('trash', 0);

        // dd($id);  
        return view('ma_approved.edit',[
            'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            'data5' => $stmt5,
            'data6' => $stmt6,
            'data7' => $stmt7,
            ]);
        try{
            $where = array('id' => $id);
            $stmt  = Ma_approved::where($where)->first();
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
        // $user_create = Auth::user() ? Auth::user()->email : 'USER_NULL';
        // $user_id = Auth::user() ? Auth::user()->id : 'USER_NULL';
        try{
            // $job_date = Carbon::now();
            // $request_date = DateTime::createFromFormat('d/m/Y', $request->get('request_date'));
            // $request_date = date("Y-m-d", strtotime($request_date->format('Y-m-d') . '- 543 years'));
            // $schedule_start_date = DateTime::createFromFormat('d/m/Y', $request->get('schedule_start_date'));
            // $schedule_start_date = date("Y-m-d", strtotime($schedule_start_date->format('Y-m-d') . '- 543 years'));
            // $schedule_end_date = DateTime::createFromFormat('d/m/Y', $request->get('schedule_end_date'));
            // $schedule_end_date = date("Y-m-d", strtotime($schedule_end_date->format('Y-m-d') . '- 543 years'));
            $stmt = Ma_approved::findOrFail($id);
            $stmt_job_update = Joborder::findOrFail($stmt->job_id);
            $stmt_job_update->job_status_id = $request->get('job_status_id');
            $stmt_job_update->save();

            $stmt->approved_by = $request->get('approved_by_text');
            $stmt->approved_dep = $request->get('approved_dep');
            $stmt->cost_ma = $request->get('cost_ma');
            $stmt->cost_c_no = $request->get('cost_c_no');
            $stmt->cost_qty = $request->get('cost_qty');
            $stmt->vendor_name = $request->get('vendor_name');
            $stmt->desc = $request->get('desc');
            // $stmt->request_sub_dep = $request->get('request_sub_dep');
            $stmt->approved_ma = $request->get('approved_ma');
            $stmt->ap_ma_no = $request->get('ap_ma_no');
            $stmt->ap_request_by = $request->get('ap_request_by');
            $stmt->ap_request_tel = $request->get('ap_request_tel');
            $stmt->ap_request_dep = $request->get('ap_request_dep');
            $stmt->ap_request_sub_dep = $request->get('ap_request_sub_dep');
            $stmt->ap_asset_send = $request->get('ap_asset_send');
            $stmt->ap_asset_brand = $request->get('ap_asset_brand');
            $stmt->ap_asset_model = $request->get('ap_asset_model');
            $stmt->ap_asset_serial = $request->get('ap_asset_serial');
            $stmt->ap_asset_no = $request->get('ap_asset_no');
            $stmt->ap_asset_desc = $request->get('ap_asset_desc');
            $stmt->ap_asset_no = $request->get('ap_asset_no');
            $stmt->ap_asset_serial = $request->get('ap_asset_serial');
            $stmt->ap_ma_type = $request->get('ap_ma_type');
            $stmt->ap_desc = $request->get('ap_desc');
            $stmt->created_by = $request->get('created_by');
            // $stmt->branch_id = $request->get('branch_id');
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());

             return redirect('/ma_approved/'.$id.'/edit')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/ma_approved/'.$id.'/edit')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
            $stmt = Ma_approved::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'ma_approveds','อนุมัติซ่อมบำรุง');
                return redirect('/ma_approved')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/ma_approved')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
    }
}
