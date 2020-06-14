<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Assetmodel;
use App\Branch;
use App\Assetgroup;
use Redirect,Response;
use App\Traits;
use DataTables;

class AssetmodelController extends Controller
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
        $stmt2 = Assetgroup::all()->where('trash', 0);
        $stmt1 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        return view('assetmodel.index', [
            'data1' => $stmt1,
            'data2' => $stmt2,
            ]);
    }

    public function getdata(Request $request)
    {
        $whereBranch = $this->getBranchId();
        return Datatables::of(Assetmodel::query()
        ->select('assetmodels.*', 'assetgroups.name as as_name','branches.short_name as b_name')
        ->Join('branches', 'assetmodels.branch_id', '=', 'branches.id')
        ->Join('assetgroups', 'assetmodels.a_g_id', '=', 'assetgroups.id')
        ->where('assetmodels.trash', 0)
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
        try{
            $stmt = new Assetmodel(
            [  
                'branch_id' => $request->get('branch_id'),
                'a_g_id' => $request->get('a_g_id'),
                'asset_m_no' => $request->get('asset_m_no'),
                'name_th' => $request->get('name_th'),
                'name_en' => $request->get('name_en'),
                'desc' => $request->get('desc'),
                'trash' => 0,
            ]);
            $stmt -> save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/assetmodel')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/assetmodel')->with('error', $e->getMessage());
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
        try{
            $where = array('id' => $id);
            $stmt  = Assetmodel::where($where)->first();
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
        try{
            $stmt = Assetmodel::findOrFail($id);
            $stmt->branch_id = $request->get('branch_id');
            $stmt->a_g_id = $request->get('a_g_id');
            $stmt->asset_m_no = $request->get('asset_m_no');
            $stmt->name_th = $request->get('name_th');
            $stmt->name_en = $request->get('name_en');
            $stmt->desc = $request->get('desc');
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
             return redirect('/assetmodel')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/assetmodel')->with('error', 'เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้');
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
            $stmt = Assetmodel::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
                return redirect('/assetmodel')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/assetmodel')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
    }
}
