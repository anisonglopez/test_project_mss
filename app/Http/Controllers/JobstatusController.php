<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobstatus;
use Redirect,Response;
use App\Traits;
use DataTables;

class JobstatusController extends Controller
{
    use Traits; // for Save logs
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stmt = Jobstatus::all()->where('trash', 0);
         //dd($mg);
        return view('jobstatus.index', ['data' => $stmt]);
    }
    public function getdata(Request $request)
    {
        // dd($request);
        return Datatables::of(Jobstatus::query()->where('trash', 0)->get())->make(true);
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
            $stmt = new Jobstatus(
            [  
                'name' => $request->get('name'),
                'desc' => $request->get('desc'),
                'code' => $request->get('code'),
                'trash' => 0,
            ]);
            $stmt -> save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/jobstatus')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/jobstatus')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
            $stmt  = Jobstatus::where($where)->first();
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
            $stmt = Jobstatus::findOrFail($id);
            $stmt->name = $request->get('name');
            $stmt->desc = $request->get('desc');
            // $stmt->code = $request->get('code');
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
             return redirect('/jobstatus')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
            }
            catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/jobstatus')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
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
            $stmt = Jobstatus::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'jobstatuses','ประเภทสถานะงาน');
                return redirect('/jobstatus')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/jobstatus')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
    }
}
