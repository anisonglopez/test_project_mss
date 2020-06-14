<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Joborder;
use App\M_Stock;
use App\Material;
use App\Materialgroup;
use App\Branch;
use DB;
use Redirect,Response;
use App\Traits;
use DataTables;

class DashboardController extends Controller
{
    use Traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index', [
            ]);
        //
    }
    
    public function dashboard2()
    {
        return view('dashboard.dashboard2', [
            ]);
    }

    public function getdataoutstock(Request $request)
    {
        // dd($request);
        $whereBranch = $this->getBranchId();
        return Datatables::of (Material::query()
        ->select('materials.*', 
                'material_types.name as m_t_name',
                'branches.short_name as b_name',
                'materialgroups.name as m_g_name',
                // 'IFNULL(m__stocks.qty_balance,0)',
                'units.name_th as u_name',
                DB::raw("IFNULL(m__stocks.qty_balance,0) as qty_balance"))
        ->Join('branches', 'materials.branch_id', '=', 'branches.id')
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->Join('units', 'materials.unit_id', '=', 'units.id')
        ->leftJoin('m__stocks', 'materials.id', '=', 'm__stocks.m_id')
        ->whereRaw('branches.id = '. $whereBranch) 
        ->whereRaw('m__stocks.qty_balance < materials.min')
        ->orWhere('m__stocks.qty_balance', null)
        ->where('materials.status', 1)
        ->where('materials.trash', 0)
        ->get())->make(true);

        //
    }

    public function getdatajoborder(Request $request)
    {
        $whereBranch = $this->getBranchId();
        return Datatables::of(Joborder::query()
        ->select('joborders.*', 'jobstatuses.name as js_name',
                 'jobtypes.name as jt_name','employees.f_name','employees.l_name',
                 'branches.short_name as b_name','priorities.name as p_name','priorities.color_code as color_name',
                 'priorities.expire_date')
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
        ->where('jobstatuses.code','!=','CLOSE' )
        ->get())->make(true);
    }

    public function dashboard2_getdata(Request $request)
    {
        $whereBranch = $this->getBranchId();
        $barchart = Joborder::query()    
         ->select('joborders.*', 'jobstatuses.name as js_name',
        'jobtypes.name as jt_name','employees.f_name','employees.l_name',
        'branches.short_name as b_name','priorities.name as p_name','priorities.color_code as color_name',
        'priorities.expire_date',DB::raw('count(*) as total'))
        ->Join('jobstatuses', 'joborders.job_status_id', '=', 'jobstatuses.id')
        ->join('users','joborders.assign_as','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->leftjoin('jobtypes', 'joborders.job_type_id', '=', 'jobtypes.id')
        ->Join('branches', 'joborders.branch_id', '=', 'branches.id')
        ->Rightjoin('priorities', 'joborders.priority_id', '=', 'priorities.id')
        ->where('joborders.trash', 0)
        ->where('jobstatuses.code','!=','CLOSE' )
        ->whereRaw('branches.id = '. $whereBranch)
        ->groupBy('jobstatuses.id')
        ->get()->toJson();
   
        return response()->json([
            'barchart' => $barchart
            ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
