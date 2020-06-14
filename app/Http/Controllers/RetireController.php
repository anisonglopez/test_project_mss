<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Retire;
use App\Asset;
use App\Branch;
use App\Outtype;
use App\Material;
use App\Receive_Detail;
use App\Retire_Detail;
use DB;
use Redirect,Response;
use App\Traits;
use DateTime;
use DataTables;

class RetireController extends Controller
{
    use Traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('retire.index');
    }
    public function getdata(Request $request)
    {
        $whereBranch = $this->getBranchId();
        return DataTables::of(Retire::query()
        ->select('retires.*','branches.short_name as b_name',
                            'outtypes.name as out_name',
                            'materials.name as m_name','materials.m_no',
                            'retire__details.qty_out as q_out','employees.f_name',
                            'employees.l_name')
        ->join('users','retires.retire_by','=','users.id')
        ->Join('employees', 'users.emp_id', '=', 'employees.id')
        ->leftJoin('materials', 'retires.id', '=', 'materials.id')
        ->leftJoin('retire__details', 'retires.id', '=', 'retire__details.id')
        ->Join('branches', 'retires.branch_id', '=', 'branches.id')
        ->Join('outtypes', 'retires.outtype_id', '=', 'outtypes.id')
        ->whereRaw('branches.id = '. $whereBranch)
        ->where('retires.trash', 0)
        ->whereBetween('retires.created_at', [
            $request->get('startDate').' 00:00:00',
            $request->get('endDate').' 23:59:59',
        ])
        ->get())->make(true);
    
    }
    public function searchResult($querystring)
    {
        // dd($querystring);
        return view('retire.searchresult');
        //
    }
    public function getmaterial(Request $request)
    {
        $whereBranch = $this->getBranchId();
        $stmt = Material::query()
        ->select('materials.*', 'branches.short_name as branch_name','materialgroups.name as m_g_name',
                'materials.id as material_id',
                DB::raw("IFNULL(m__stocks.qty_balance,0) as qty_balance"),
                'material_types.name as m_t_name')
        ->Join('branches', 'materials.branch_id', '=', 'branches.id')
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->leftJoin('m__stocks', 'materials.id', '=', 'm__stocks.m_id')
        ->whereRaw('branches.id = '. $request->get('branch_id'))
        ->where('materials.trash', 0)
        ->where('materials.status', 1)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered small">
            <thead class="bg-primary text-white">
                <tr  class="text-center">
                    <th>หน่วยงาน</th>
                    <th>Material No</th>
                    <th>ประเภท</th>
                    <th>ชนิด</th>
                    <th>ชื่อวัสดุอุปกรณ์</th>
                    <th>Stock Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td class="text-center">'.$row->m_no.'</td>
                    <td class="text-center">'.$row->m_g_name.'</td>
                    <td class="text-center">'.$row->m_t_name.'</td>
                    <td>'.$row->name.'</td>
                    <td class="text-center">'.$row->qty_balance.'</td>
                    <td class="text-center"><a data-id="'.$row->material_id.'" data-value="'.$row->name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formMaterial';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลวัสดุอุปกรณ์',
        ];
    }

    public function getasset(Request $request)
    {
        
        $whereBranch = $this->getBranchId();
        $stmt = Asset::query()
        ->select('assets.*', 'branches.short_name as branch_name',
                             'assetmodels.name_th as a_name',
                             'departments.name_th as d_name',
                             'checkinstatuses.name as c_name')
        ->Join('assetmodels', 'assets.a_m_id', '=', 'assetmodels.id')
        ->Join('departments', 'assets.owner_dep', '=', 'departments.id')
        ->Join('checkinstatuses', 'assets.asset_status', '=', 'checkinstatuses.id')
        ->Join('branches', 'assets.branch_id', '=', 'branches.id')
        ->whereRaw('branches.id = '. $request->get('branch_id'))
        ->where('assets.trash', 0)
        ->get();
        $table  = '<table id="component_datatable_modal" class="table table-sm table-hover table-bordered">
            <thead class="">
                <tr  class="text-center">
                    <th>สาขา</th>
                    <th>เจ้าของทรัพย์สิน</th>
                    <th>สถานะทรัพย์สิน</th>
                    <th>รหัสทรัพย์สิน</th>
                    <th>โมเดลทรัพย์สิน</th>
                    <th>เลขซีเรียล</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($stmt as $row):
        $table  .='
                <tr>
                    <td class="text-center">'.$row->branch_name.'</td>
                    <td class="text-center">'.$row->d_name.'</td>
                    <td>'.$row->c_name.'</td>
                    <td class="text-center">'.$row->asset_no.'</td>
                    <td class="text-center">'.$row->a_name.'</td>
                    <td class="text-center">'.$row->serial_no.'</td>
                    <td class="text-center"><button data-id="'.$row->asset_no.'" data-value="'.$row->name.'" href="#" class="btn btn-success btn-sm btnmodal_add"><span class="fa fa-plus"></span></button></td>
                </tr>
                ';
    endforeach;
    $table .= '</tbody>
    </table>';
        $frmAction =  'formAsset';
        return   [
            'table' => $table,
            'frmAction' => $frmAction,
            'title' => 'ข้อมูลทรัพย์สิน',
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
        $stmt1 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt2 = Outtype::all()->where('trash', 0);
        return view('retire.create',[
            'data1' => $stmt1,
            'data2' => $stmt2,
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
        try{
            // $receive_date = DateTime::createFromFormat('d/m/Y', $request->get('receive_date'));
            $stmt = new Retire(
            [  
                'retire_no' => $request->get('retire_no'),
                'outtype_id' => $request->get('outtype_id'),
                'desc' => $request->get('desc'),
                'retire_by' => $request->get('retire_by'),
                'branch_id' => $request->get('branch_id'),
                'retire_status' => 'new',
                'trash' => 0,
            ]);
            //  dd($stmt);
            $stmt -> save();
            // dd($request);
            $lastid = $stmt->id;
    
            //  ----------- Stock Transaction ----------
            if($request->get('stock_transaction')):
                $i = 0;
                foreach ($request->get('m_id') as $row) :
                    $stmt_detail = new Retire_Detail(
                        [  
                            'retire_id' => $lastid,
                            'm_id' => $request->get('m_id')[$i],
                            'qty_out' => $request->get('qty_out')[$i],
                            'remark' => $request->get('remark')[$i],
                            'qty_balance_as' => $request->get('qty_balance_as')[$i],
                        ]);
                        $stmt_detail -> save();
                $i++;
                endforeach;
            endif;
            // dd($stmt_detail);
             //  ----------- Stock Transaction ----------
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/retire/'.$lastid.'/edit')->with('success', 'บันทึกข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/retire')->with('error', $e->getMessage());
                // dd($e->getMessage());
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
        $stmt = Retire::findOrFail($id);
        $stmt1 = Branch::query()
        ->select('*')
        -> where('trash', 0)
        ->whereRaw("branches.id = ". $whereBranch)
        ->get();
        $stmt2 = Outtype::all()->where('trash', 0);
        $stmt3 = Retire_Detail::query()
        ->select('retire__details.*','materials.name as m_name','material_types.name as mt_name','materials.m_no','materialgroups.name as mg_name')
        ->Join('materials','retire__details.m_id','=','materials.id')   
        ->Join('material_types', 'material_types.id', '=', 'materials.m_t_id')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->where('retire__details.retire_id',$id)
        ->get();
        return view('retire.edit',[
            'data' => $stmt,
            'data1' => $stmt1,
            'data2' => $stmt2,
            'data3' => $stmt3,
        ]);
        try{
            $where = array('id' => $id);
            $stmt  = Retire::where($where)->first();
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
            $retire_status = $request->get('confirm') == 'confirm' ? 'confirm' : 'new';
            // $receive_date = DateTime::createFromFormat('d/m/Y', $request->get('receive_date'));
            $stmt = Retire::findOrFail($id);
            $stmt->retire_no = $request->get('retire_no');
            $stmt->outtype_id = $request->get('outtype_id');
            $stmt->desc = $request->get('desc');
            $stmt->retire_by = $request->get('retire_by');
            $stmt->branch_id = $request->get('branch_id');
            $stmt->retire_status = $retire_status;
            // dd($stmt);
            $stmt->save();
            //  ----------- Stock Transaction ----------
            if($request->get('stock_transaction')):
                $i = 0;
                $operator = '-';
                foreach ($request->get('m_id') as $row) :
                    $qty = $request->get('qty_out')[$i];
                    $m_id = $request->get('m_id')[$i];
                    $remark = $request->get('remark')[$i];
                    $qty_balance_as = $request->get('qty_balance_as')[$i];
                        $stmt_detail = Retire_Detail::updateOrCreate(
                                ['id' => $request->get('_id')[$i]],
                                [
                                    'retire_id' => $id,
                                    'm_id' => $m_id,
                                    'qty_out' => $qty,
                                    'remark' => $remark,
                                    'qty_balance_as' => $qty_balance_as,
                                ]);
                        $stmt_detail -> save();
                        if ($retire_status == 'confirm'):
                            $result = $this->StockTransaction($m_id, $qty, $operator,$remark);      
                        endif;
                        $i++;
                        
                endforeach;    
            endif;
            //  ----------- Stock Transaction ----------
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/retire/'.$id.'/edit')->with('success', 'ปรับปรุงข้อมูลสำเร็จ');
                }catch (\Exception $e) {
                    $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                    return redirect('/retire/'.$id.'/edit')->with('error', 'เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูลได้');
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
            $stmt = Retire::findOrFail($id);
            $stmt->trash = 1;
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            // Recovery Data
            $result = $this->saveTrash( 'OK',__FUNCTION__, app('request')->route()->getAction(),json_decode($stmt, true),$id,1,'retires','จำหน่ายออก');
                return redirect('/retire')->with('success', 'ลบข้อมูลสำเร็จ');
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/retire')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
            }
    }
    public function deletedetail($id)
    {
        try{
            $stmt = Retire_Detail::findOrFail($id);
            $stmt->delete();
             $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
                return "OK";
             }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return $e->getMessage();
            }
    }
}
