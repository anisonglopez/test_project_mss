<?php

namespace App\Http\Middleware;
use Closure;
use DB;
use Auth;
use App\Role;
use App\User;
use App\UserInRole;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user_id = Auth::user() ? Auth::user()->id : '';
        $stmt = Role::Query()
        ->select('role_permissions.code')
        ->Join('user_in_roles', 'roles.id', '=', 'user_in_roles.role_id')
        ->Join('role_permissions', 'roles.id', '=', 'role_permissions.role_id')
        ->where('roles.trash', 0)
        ->where('user_id', $user_id )
        ->where('role_permissions.code', $permission )
        ->count();
        if( Auth::check() && $stmt >= 1 ) {
            return $next($request);
        } 
        else {
            abort(403, 'Unauthorized action. คุณไม่ได้รับสิทธิ์ในการเข้าถึงข้อมูล');
        }
    }
}