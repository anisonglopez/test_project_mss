<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\M_Stock;
use App\Material;
use App\Unit;
use App\Branch;
use App\Materialgroup;
use App\Material_type;
use DB;
use Redirect,Response;
use App\Traits;
use DataTables;

class MaterialController extends Controller
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
        $stmt2 = Materialgroup::all()->where('trash', 0);
        $stmt3 = unit::all()->where('trash', 0);
        $stmt4 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        return view('material.index', [
            // 'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            'data4' => $stmt4
            ]);
    }

    public function getdata(Request $request)
    {
        // dd($request);
        $whereBranch = $this->getBranchId();
        return Datatables::of(Material::query()
        ->select('materials.*', 'materialgroups.name as m_g_name', 'material_types.name as m_t_name',
        'material_types.code as m_t_code','m__stocks.qty_balance as qty',
         'units.name_th as unit_name','branches.short_name as b_name',
         DB::raw("IFNULL(m__stocks.qty_balance,0) as qty"))
        
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->Join('units', 'materials.unit_id', '=', 'units.id')
        ->Join('branches', 'materials.branch_id', '=', 'branches.id')
        ->leftJoin('m__stocks', 'materials.id', '=', 'm__stocks.id')
        // ->where('materials.status', 1)
        ->where('materials.trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
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
        //dd($request->all());
        $status = $request->get('status') ? $request->get('status') : 0;
        try{
            //$this->validate($request,['m_g_id' => 'required','m_g_desc' => 'required']);
            $material_group =  Materialgroup::where('id', $request->get('m_g_id'))->first();
            $material_type=  Material_type::where('id', $request->get('m_t_id'))->first();
            $material_no =  Material::query()
            ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
            ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
            ->where('m_t_id', $request->get('m_t_id'))
            ->where('m_g_id', $request->get('m_g_id'))
            ->count();

            $material_no += 1;
            $new_material_no = $material_group->material_code.$material_type->code.sprintf("%03d", $material_no);
            $stmt = new Material(
            [  
                'm_no' => $new_material_no,
                'name' => $request->get('name'),
                'desc' => $request->get('desc'),
                'm_t_id' => $request->get('m_t_id'),
                'max' => $request->get('max'),
                'min' => $request->get('min'),
                'branch_id' => $request->get('branch_id'),
                'status' => $status,
                'unit_id' => $request->get('unit_id'),
                'trash' => 0,
            ]);
            // dd($stmt);
            $stmt -> save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/material')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                dd($e->getMessage());
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/material')->with('error','มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
                //  $e->getMessage()
                // dd($e);
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
        $where = array('id' => $id);
        $stmt  = Material::where($where)->first();
        return Response::json($stmt);
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
        $status = $request->get('status') ? $request->get('status') : 0;
        try{
        $stmt = Material::findOrFail($id);
        if($stmt->m_t_id != $request->get('m_t_id')){
            $material_group =  Materialgroup::where('id', $request->get('m_g_id'))->first();
            $material_no =  Material::query()
            ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
            ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
            ->where('m_t_id', $request->get('m_t_id'))
            ->where('m_g_id', $request->get('m_g_id'))
            ->count();
            $material_type=  Material_type::where('id', $request->get('m_t_id'))->first();
            $material_no += 1;
            $new_material_no = $material_group->material_code.$material_type->code.sprintf("%03d", $material_no);
            $stmt->m_no = $new_material_no;
        }
        $stmt->name = $request->get('name');
        $stmt->desc = $request->get('desc');
        $stmt->m_t_id = $request->get('m_t_id');
        $stmt->max = $request->get('max');
        $stmt->min = $request->get('min');
        $stmt->branch_id = $request->get('branch_id');
        $stmt->status = $status;
        $stmt->unit_id = $request->get('unit_id');
        $stmt->save();
        $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
         return redirect('/material')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('name'));
            }catch (\Exception $e) {
                dd($e->getMessage());
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/material')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
            $stmt = Material::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'materials','ข้อมูลวัสดุอุปกรณ์');
                return redirect('/material')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/material')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
            }
    }
}
