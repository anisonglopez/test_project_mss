<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Menu;
use App\RolePermission;
use App\Branch;
use DB;
use Redirect,Response;
use App\Traits;

class RoleController extends Controller
{
    use Traits; // for Save logs
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $stmt = Role::all()->where('trash', 0);
        $stmt = DB::table('roles')
        ->select('roles.*', 'branches.short_name')
        ->Join('branches', 'branches.id', '=', 'roles.branch_id')
        ->where('roles.trash', 0)
        ->get();
        $stmt2 =  DB::table('menus')
        ->select('menus.*', 'modules.module_name')
        ->Join('modules', 'menus.module_id', '=', 'modules.id')
        ->where('menus.trash', 0)
        ->get();
        $stmt3 = Branch::all()->where('trash', 0);
        return view('role.index', [
            'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            ]);
        //
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
            $stmt = new Role(
            [
                'role_name' => $request->get('role_name'),
                'desc' => $request->get('desc'),
                'branch_id' => $request->get('branch_id'),
                'trash' => 0,
            ]);
            $stmt->save();
            $lastid = $stmt->id;
            if($request->get('code')){
                foreach ($request->get('code') as $item):
                    $stmt2 = new RolePermission(
                        [
                            'role_id' => $lastid,
                            'code' => $item,
                        ]);
                    $stmt2->save();
                endforeach;
            }      
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/role')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch (\Exception $e) {
            $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
            return redirect('/role')->with('error', $e->getMessage());
        }
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
        $where = array('id' => $id);
        $stmt  = Role::where($where)->first();
        $matchThese = ['role_id' =>$id];
        $stmt2 = RolePermission::where($matchThese)->get();
        return Response::json
        (array(
            'data' => $stmt,
            'data2' => $stmt2,
        ));
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
            $stmt = Role::findOrFail($id);
            $stmt->branch_id = $request->get('branch_id');
            $stmt->role_name = $request->get('role_name');
            $stmt->desc = $request->get('desc');
            $stmt->save();
            $stmtdelete = RolePermission::where('role_id',$id)->delete();
           if  ($request->get('code')):
                foreach ($request->get('code') as $item):
                    $stmt2 = new RolePermission(
                        [
                            'role_id' => $id,
                            'code' => $item,
                        ]);
                    $stmt2->save();
                endforeach;
            endif;
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
             return redirect('/role')->with('success', 'ปรับปรุงข้อมูลสำเร็จ ' . $request->get('name'));
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/role')->with('error', 'เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้');
                    // return redirect('/role')->with('error', $e->getMessage());
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
            $stmt = Role::where('id',$id)->delete();
            $stmt = RolePermission::where('role_id',$id)->delete();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
                return redirect('/role')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/role')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
        //
    }
}
