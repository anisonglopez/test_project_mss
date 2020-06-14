<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response;
use DB;
use DataTables;

class PhonebookController extends Controller
{
    public function phonebook_getdata(Request $request)
    {
        $phonebook_data = DB::connection('mysql2')->select("
        SELECT ph.phone_id, p.phone_number, e.employee_code,
                    e.name, l.location_name, e.position_id, po.position_name, e.com_id, c.com_name,
                    e.department_id, d.department_name, e.line_id, li.line_name,
                    e.division_id, di.division_name, e.section_id, s.section_name, ph.usage_status, ph.usage_type
                FROM pho_usage AS p
                INNER JOIN emp_employee AS e ON p.employee_code=e.employee_code
                INNER JOIN pho_phone AS ph ON p.phone_number = ph.phone_number
                LEFT JOIN loc_location AS l ON p.location_id=l.location_id
                LEFT JOIN pos_position AS po ON e.position_id=po.position_id
                LEFT JOIN com_company AS c ON (e.com_id=c.com_id)
                LEFT JOIN dep_department AS d ON (e.department_id=d.department_id)
                LEFT JOIN lin_line AS li ON (e.line_id=li.line_id) 
                LEFT JOIN div_division AS di ON (e.division_id=di.division_id)
                LEFT JOIN sec_section AS s ON e.section_id=s.section_id
                WHERE (ph.usage_type = 1) AND (ph.usage_status = 1) AND (e.employee_code NOT LIKE '9%' AND e.employee_code NOT LIKE '7%')
                GROUP BY p.employee_code, ph.phone_id
                ORDER BY e.com_id, e.department_id, e.line_id, e.division_id, e.section_id, e.position_id, e.employee_code;");
        return Datatables::of($phonebook_data)->make(true);
    }
    //
}
