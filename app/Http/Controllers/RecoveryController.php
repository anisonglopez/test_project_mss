<?php

namespace App\Http\Controllers;
use App\Log;
use App\User;
use DataTables;
use DB;
use App\Traits;

use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    use Traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recovery.index');
        //
    }
    
    public function getdata(Request $request)
    {
        return Datatables::of(Log::query()
        ->whereBetween('created_At', [
            $request->get('startDate').' 00:00:00',
            $request->get('endDate').' 23:59:59',
            ])
        ->where('trash_flag', 1)->get())->make(true);
           
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
        try{
            $stmt = Log::findOrFail($id);
           $stmt2 = DB::table($stmt->trash_table_name)->where('id', $stmt->job_id)
            ->update([
                'trash' => 0
            ]);
            $stmt->trash_flag = 0;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
             return redirect('/recovery')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('id'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/recovery')->with('error', 'มีข้อมูลซ้ำกับในระบบหรือถูกลบไปแล้ว');
                }
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
        try{
            $stmt = Log::findOrFail($id);
            DB::table($stmt->trash_table_name)->where('id', $stmt->job_id)->delete();
            $stmt->delete();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/recovery')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                 dd($e);
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/recovery')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
        //
    }
}
