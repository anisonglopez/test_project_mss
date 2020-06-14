<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\Role;
use App\Branch;
use App\UserInRole;
use DB;
use Auth;
use Redirect,Response;
use App\Traits;
use DataTables;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    use Traits; // for Save logs
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $stmt2 = Role::all();
        $stmt4 = Employee::all();
        $stmt3 =  Branch::all()->where('trash', 0);        
        return view('user.index', [
            // 'data' => $stmt,
            'data2' => $stmt2,
            'data3' => $stmt3,
            'data4' => $stmt4,
            ]);
    }
    public function getdata(Request $request)
    {
        $userQuery = DB::select('SELECT users.*, employees.f_name ,employees.l_name , departments.name_th as dep_name, branches.short_name as branch_name,
        GROUP_CONCAT(roles.role_name) as role_name
        FROM users  
        JOIN employees ON employees.id = users.emp_id
        JOIN departments ON departments.id = employees.dep_id
        JOIN branches ON branches.id = users.branch_id 
        Left Join user_in_roles ON user_in_roles.user_id = users.id
        Left Join roles ON roles.id = user_in_roles.role_id
        GROUP BY users.id
        ');
       return Datatables::of($userQuery)->make(true);
    }

    public function resetPassword(Request $request)
    {
       return "resetPassword";
    }

    public function changepassword(Request $request)
    {
       
        $current_pass = $request->get('current_password');
        $new_pass = $request->get('new_password');
        $id = $request->get('id');
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return 'False_1';
        }
        try{
            $stmt = User::findOrFail($id);
            $stmt->password =  Hash::make($new_pass);
            $stmt->updated_at =  Carbon::now();
            $stmt->save();
            $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return "Ture";
        }catch (\Exception $e) {
            $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
            return "False_2";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $status = $request->get('status') ? $request->get('status') : 0;
        // $this->validate($request,['fname' => 'required' , 'lname' => 'required']);
        try{
            $stmt = User::updateOrCreate(
            [
                ['id' => $request->user_id],
                'emp_id' => $request->get('emp_id'),
                'branch_id' => $request->get('branch'),
                'status' => $status,
                'email' => $request->get('email'),
                'email_real' => $request->get('email_real'),
                'tel' => $request->get('tel'),
                'password' => Hash::make($request->get('password')),
            ]
        );
            $stmt->save();
            $lastid = $stmt->id;
            if($request->get('roles')){
                foreach ($request->get('roles') as $item):
                    $stmt2 = new UserInRole(
                        [
                            'user_id' => $lastid,
                            'role_id' => $item,
                        ]);
                    $stmt2->save();
                    $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            endforeach;
        }
         
            // dd($request);
            return redirect('/user')->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch (\Exception $e) {
            
            $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
            // return redirect('/user')->with('error', 'เกิดข้อผิดพลาด ชื่ออีเมลซ้ำกันในระบบ');
            // return redirect('/user')->with('error', $e->getMessage());
            return redirect('/user')->with('error', 'มีข้อมูลอยู่ในระบบหรือถูกลบไปแล้ว');
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
        $stmt  = User::where($where)->first();
        $matchThese = ['user_id' =>$id];
        $stmt2 = UserInRole::query()
        ->select('*')
        ->Join('roles', 'roles.id', '=', 'user_in_roles.role_id')
        ->where('roles.trash', 0)
        ->where($matchThese)
        ->get();

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
        $status = $request->get('status') ? $request->get('status') : 0;
        try{
        $stmt = User::findOrFail($id);
        $stmt->emp_id = $request->get('emp_id');
        $stmt->branch_id = $request->get('branch');
        $stmt->email_real = $request->get('email_real');
        $stmt->tel = $request->get('tel');
        $stmt->status = $status;
        if($request->get('password')){
            $stmt->password =  Hash::make($request->get('password'));
        }
        $stmt->tel = $request->get('tel');
        $stmt->updated_at =  Carbon::now();
        $stmt->save();
        $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());

        $stmtdelete = UserInRole::where('user_id',$id)->delete();
        if($request->get('roles')){
            foreach ($request->get('roles') as $item):
                $stmt2 = new UserInRole(
                    [
                        'user_id' => $id,
                        'role_id' => $item,
                    ]);
                $stmt2->save();
                $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction(), json_decode($stmt2, true));
        endforeach;
        }
         return redirect('/user')->with('success', 'ปรับปรุงข้อมูลสำเร็จ');
            }catch (\Exception $e) {
                $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
                return redirect('/user')->with('error', 'มีข้อมูลอยู่ในระบบหรือถูกลบไปแล้ว');
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
        $stmt = User::where('id',$id)->delete();
        $this->saveLog( 'OK', __FUNCTION__, app('request')->route()->getAction());
            return redirect('/user')->with('success', 'ลบข้อมูลสำเร็จ');
         }catch (\Exception $e) {
            $this->saveLog( 'ERROR', __FUNCTION__, app('request')->route()->getAction(), $e->getMessage());
            return redirect('/user')->with('error', 'เกิดข้อผิดพลาด ไม่สามารถลบข้อมูลได้');
        }
    }

    public function checkEmail($email)
    {
        $where = array('email' => $email);
        $stmt  = User::where($where)->first();
        return Response::json($stmt);
    }
}

