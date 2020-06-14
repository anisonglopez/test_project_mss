<?php
namespace App;
use App\Log;
use App\UserInRole;
use Auth;
use App\M_Stock;
use Illuminate\Http\Request;

trait Traits {
    public function saveLog($status, $func, $action )
    {

        // $text = var_export($desc, true);
        // $text = trim($text , "'" );
        // echo $text;
        $email = Auth::user() ? Auth::user()->email : 'USER_NULL';
        try{
            $stmt = new Log(
            [  
                'action' => $func,
                'module' =>$action['controller'],
                'user' => $email,
                'page' =>  $action['as'],
                'status' =>$status,
            ]);
            $stmt -> save();
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }
    public function saveLogAdvance($status, $func, $action, $desc ,  $job_id, $job_process )
    {
        // return $action;
        $text = var_export($desc, true);
        $text = trim($text , "'" );
        // echo $text;
        $email = Auth::user() ? Auth::user()->email : 'USER_NULL';
        try{
            $stmt = new Log(
            [  
                'action' => $func,
                'module' =>$action['controller'],
                'user' => $email,
                'page' =>  $action['as'],
                'desc' =>  $text,
                'status' =>$status,
                'job_id' =>$job_id,
                'job_process' =>$job_process,
            ]);
            $stmt -> save();
            return 'ok ' . $job_process ;
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }
    public function saveTrash($status, $func, $action, $desc,  $job_id,$trash_flag, $trash_table_name,$job_process )
    {
        $email = Auth::user() ? Auth::user()->email : 'USER_NULL';
        $text = var_export($desc, true);
        $text = trim($text , "'" );
        try{
            $stmt = new Log(
            [    
                'action' => $func,
                'module' =>$action['controller'],
                'status' =>$status,
                'page' =>  $action['as'],
                'user' => $email,
                'desc' => $text,
                'job_id' =>$job_id,
                'trash_flag' => $trash_flag,
                'job_process' =>$job_process,
                'trash_table_name' => $trash_table_name
            ]);
            $stmt -> save();
            return 'ok ' . $job_id ;
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }
    public function getBranchId()
    {
        $user_id = Auth::user() ? Auth::user()->id : '';
        try{
                $stmt2 = UserInRole::Query()
                ->select('branches.id')
                ->Join('roles', 'user_in_roles.role_id', '=', 'roles.id')
                ->Join('branches', 'roles.branch_id', '=', 'branches.id')
                ->where('user_in_roles.user_id', $user_id )
                ->distinct()
                ->get();
                $branch_id = '';
                foreach ($stmt2 as $row) :
                    $branch_id = $branch_id . ' ' . $row->id . ' or ';
                endforeach;
                $branch_id  = rtrim($branch_id, ' or ');
                return $branch_id;
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }
    public function StockTransaction($m_id, $qty, $operator)
    {
        try{
            $stmt_check = M_Stock::all()->where('m_id', $m_id)->first();
            $qty_balance = 0;
            if (isset($stmt_check)){
                $qty_balance = $stmt_check['qty_balance'] == null ? 0 : $stmt_check['qty_balance'];
            }
            // return $qty_balance ;    
            switch ($operator){
                case "+" :
                $qty_total = intval($qty + $qty_balance);
                break;
                case "-" :
                $qty_total = abs($qty - $qty_balance);
                break;
            }
            if ( $qty_total < 0){
                $qty_total = 0;
            }
                $stmt = M_Stock::updateOrCreate(
                [
                    'm_id' => $m_id],[
                    'm_id' => $m_id,
                    'qty_balance' => $qty_total,
                ]);
                $stmt -> save();            
                return "ok";
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }

    public function StockTransaction_material($m_id, $qty_in, $qty_out)
    {
        $stmt_check = M_Stock::all()->where('m_id', $m_id)->first();
        $qty_balance = $stmt_check['qty_balance'] == null ? 0 : $stmt_check['qty_balance']; 
        $qty_total = ($qty_balance - $qty_out) + $qty_in;
        if ( $qty_total < 0){
            $qty_total = 0;
            // return 'error ' ;
        }
        // switch ($operator){
        //     case "+" :
        //     $qty_total = intval($qty + $qty_balance);
        //     break;
        //     case "-" :
        //     $qty_total = abs($qty - $qty_balance);
        //     break;
        // }
        try{
                $stmt = M_Stock::updateOrCreate(
                [
                    'm_id' => $m_id],[
                    'm_id' => $m_id,
                    'qty_balance' => $qty_total,
                ]);
                $stmt -> save();            
                return "ok";
            }catch (\Exception $e) {
                return 'error ' . $e->getMessage();
            }
    }

}