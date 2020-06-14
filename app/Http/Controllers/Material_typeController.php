<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material_type;
use App\Materialgroup;
use App\Branch;
use DB;
use Redirect,Response;
use App\Traits;
use DataTables;

class Material_typeController extends Controller
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
        $stmt4 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        return view('material_type.index', [
            // 'data' => $stmt,
            'data2' => $stmt2,
            'data4' => $stmt4,
            ]);
    }
    public function getdata(Request $request)
    {
        // dd($request);
        return Datatables::of(Material_type::query()
        ->select('material_types.*', 'materialgroups.name as m_g_name')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->where('material_types.trash', 0)
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
            $check_duplicate =  Material_type::all()
            ->where('m_g_id', $request->get('m_g_id'))
            ->where('code', $request->get('code'))
            ->count();
            if($check_duplicate >= 1){
                $err_msg =  'ประเภท Materail, รหัส ซ้ำในระบบ';
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $err_msg );
                return redirect('/materialtype')->with('error',  $err_msg );
            }
            //$this->validate($request,['m_g_id' => 'required','m_g_desc' => 'required']);
            $stmt = new Material_type(
            [  
                'm_g_id' => $request->get('m_g_id'),
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'desc' => $request->get('desc'),
                'trash' => 0,
            ]);
            $stmt -> save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
           
            return redirect('/materialtype')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/materialtype')->with('error', $e->getMessage());
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
            $stmt  = Material_type::where($where)->first();
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
            $stmt = Material_type::findOrFail($id);
            if ($stmt->m_g_id != $request->get('m_g_id') ||$stmt->code != $request->get('code') ){
                $check_duplicate =  Material_type::all()
                ->where('m_g_id', $request->get('m_g_id'))
                ->where('code', $request->get('code'))
                ->count();
                if($check_duplicate >= 1){
                    $err_msg =  'ประเภท Materail, รหัส ซ้ำในระบบ';
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $err_msg );
                    return redirect('/materialtype')->with('error',  $err_msg );
                }
            }
            $stmt->m_g_id = $request->get('m_g_id');
            $stmt->code = $request->get('code');
            $stmt->name = $request->get('name');
            $stmt->desc = $request->get('desc');
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
             return redirect('/materialtype')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/materialtype')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
            $stmt = Material_type::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'material_types','ข้อมูลชนิดวัสดุอุปกรณ์');
                return redirect('/materialtype')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/materialtype')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
            }
    }
}
