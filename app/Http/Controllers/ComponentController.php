<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Employee;
use App\Department;
use App\DepInBranch;
use App\Material;
use App\Material_type;
use App\Joborder;
use App\Traits;
use DB;

class ComponentController extends Controller
{
    use Traits;
    public function get_branch_from_com($request)
    {
        $matchThese = ['com_id' =>$request, 'trash' =>0];
        $stmt = Branch::where($matchThese)->get();
        return $stmt;
    }
    public function get_dep_from_branch($request)
    {
        $matchThese = ['branch_id' =>$request, 'trash' =>0];
        $stmt = DepInBranch::query()
        ->select('*')
        ->Join('departments', 'dep_in_branches.dep_id', '=', 'departments.id')
        ->where($matchThese)
        ->get();
        return $stmt;
    }
    public function get_emp_from_branch($request)
    {
        $matchThese = ['branch_id' =>$request, 'trash' =>0];
        $stmt = Employee::query()
        ->select('*')
        ->where($matchThese)
        ->get();
        return $stmt;
    }
    public function get_material()
    {
        $stmt = Material::all()->where('trash', 0);
        return  $stmt;
    }
    public function get_material_type($request)
    {
        $matchThese = ['m_g_id' =>$request, 'trash' =>0];
        $stmt = Material_type::query()
        ->select('*')
        ->where($matchThese)
        ->get();
        return  $stmt;
    }
    public function get_mg_from_material($request)
    {
        $matchThese = ['material_types.id' =>$request, 'material_types.trash' =>0];
        $stmt = Material_type::query()
        ->select('material_types.*' , 'materialgroups.id as m_g_id' , 'materialgroups.material_code')
        ->Join('materialgroups', 'material_types.m_g_id', '=', 'materialgroups.id')
        ->where($matchThese)
        ->get();
        return  $stmt;
    }

    public function get_job_order($request)
    {
        $matchThese = ['id' =>$request, 'trash' =>0];
        $stmt = Joborder::query()
        ->select('*')
        ->where($matchThese)
        ->get();
        return $stmt;
    }
    public function get_count_min_material()
    {
        $whereBranch = $this->getBranchId();
        $matchThese = ['trash' =>0];
        $stmt = Material::query()
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
        ->count();
        return $stmt;
    }
    public function get_min_material_list()
    {
        $whereBranch = $this->getBranchId();
        $matchThese = ['trash' =>0];
        $stmt = Material::query()
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
        ->limit(7)
        ->get();

        $html = '';
        foreach ($stmt as $row) :
            $html .= '<a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
          
            </div>
            <div>
              <div class="small text-gray-500">ประเภท: '.$row->m_g_name .' ชนิด: '.$row->m_t_name .' รหัส: '.$row->m_no.'</div>
              <span class="font-weight-bold">'.$row->name .' <label class="text-danger">คงเหลือ '.$row->qty_balance.'</label></span>
            </div>
          </a>';
        endforeach;
        

        $html .= ' ';
        return $html;
    }
    //
}
