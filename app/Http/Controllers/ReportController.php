<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.index');
    }
    public function reportSearch(Request $request)
    {
        $report_filter = $request->report_filter;
        if ($report_filter == "R01"){
            return $this->R01view();
        }elseif ($report_filter == "R02"){
            return $this->R02view();
        }elseif ($report_filter == "R03"){
            return $this->R03view();
        }elseif ($report_filter == "R04"){
            return $this->R04view();
        }elseif ($report_filter == "R05"){
            return $this->R05view();
        }elseif ($report_filter == "R06"){
            return $this->R06view();
        }elseif ($report_filter == "R07"){
            return $this->R07view();
        }
    }
    public function R01view($id)
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
        $pdf = PDF::loadView('report.R01_Job_report_all',$data);
        return $pdf->stream('ใบสั่งงาน-2.pdf');   
        
    }
    // public function R01view()
    // {
    //     return view('report.R01_Job_report_all');
    // }
    public function R02view()
    {
        return view('errors.404');
    }
    public function R03view()
    {
        return view('report.R03-job_open');
    }

    public function R04view()
    {
        return view('errors.404');
    }
    public function R05view()
    {
        return view('errors.404');
    }
    public function R06view()
    {
        return view('errors.404');
    }
    public function R07view()
    {
        return view('errors.404');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
