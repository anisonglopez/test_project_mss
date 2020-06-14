<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\M_Stock;
use App\Material;
use App\Materialgroup;
use App\Branch;
use DB;
use Redirect,Response;
use App\Traits;
use DataTables;

class M_StockController extends Controller
{
    use Traits;/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $whereBranch = $this->getBranchId();
        // $stmt = M_Stock::all()->where('trash', 0);
        // $stmt1 = Material::all()->where('trash', 0);
        // $stmt2 = Materialgroup::all()->where('trash', 0);
        // $stmt3 = Branch::query()
        // ->select('*')
        // -> where('trash', 0)
        // ->whereRaw("branches.id = ". $whereBranch)
        // ->get();
        return view('m_stock.index', [
            // 'data' => $stmt,
            // 'data1' => $stmt1,
            // 'data2' => $stmt2,
            // 'data3' => $stmt3,
            ]);
    }
    public function getdata(Request $request)
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
        ->where('materials.status', 1)
        ->where('materials.trash', 0)
        ->get())->make(true);
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
