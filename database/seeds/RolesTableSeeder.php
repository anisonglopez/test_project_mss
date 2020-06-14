<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\RolePermission;
use Carbon\Carbon;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'branch_id' => 1,
            'role_name' => 'Admin',
            'desc' => '',
            
            'created_at' => Carbon::now(),
        ]);
        Role::insert([
            'branch_id' => 1,
            'role_name' => 'Supervisor',
            'desc' => '',
            
            'created_at' => Carbon::now(),
        ]);
        Role::insert([
            'branch_id' => 1,
            'role_name' => 'User',
            'desc' => '',
            
            'created_at' => Carbon::now(),
        ]);
        Role::insert([
            'branch_id' => 1,
            'role_name' => 'Itbc',
            'desc' => '',
            
            'created_at' => Carbon::now(),
        ]);
/////////////////////////// ADMIN /////////////////////////////
    //Branch
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'branch.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'branch.edit',
            
            'created_at' => Carbon::now(),
        ]);
    //Department
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'department.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'department.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'department.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'department.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialtype
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialgroup
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialgroup.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialgroup.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialgroup.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'materialgroup.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Material
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'material.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'material.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'material.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'material.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Unit
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'unit.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'unit.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'unit.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'unit.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Employee
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'employee.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'employee.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'employee.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'employee.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Intype
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'intype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'intype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'intype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'intype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Outtype
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'outtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'outtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'outtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'outtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Jobstatus
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobstatus.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobstatus.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobstatus.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobstatus.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Priority
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'priority.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'priority.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'priority.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'priority.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //User
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'user.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'user.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'user.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'user.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Role
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'role.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 1,
        //     'code' => 'role.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 1,
        //     'code' => 'role.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 1,
        //     'code' => 'role.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Joborder
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.delete',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.print_frm01',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.confirm',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'joborder.send_ap',
            
            'created_at' => Carbon::now(),
        ]);
    //Receive
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'receive.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'receive.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'receive.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'receive.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Retriement
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'retirement.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'retirement.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'retirement.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'retirement.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Stock-management
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'stock-management.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'stock-management.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'stock-management.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'stock-management.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Dashboard
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'dashboard.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Log
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'log.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Report
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'report.view',
            
            'created_at' => Carbon::now(),
        ]);
    //jobtype
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'jobtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Ma Approved
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'ma_approved.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'ma_approved.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'ma_approved.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'ma_approved.delete',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'ma_approved.print_frm02',
            
            'created_at' => Carbon::now(),
        ]);
    //Recovery
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'recovery.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'recovery.rollback',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 1,
            'code' => 'recovery.delete',
            
            'created_at' => Carbon::now(),
        ]);
        
/////////////////////////// ITBC /////////////////////////////
    //Company
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'company.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'company.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'company.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'company.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Branch
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'branch.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'branch.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'branch.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'branch.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Businessunit
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'businessunit.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'businessunit.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'businessunit.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'businessunit.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Department
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'department.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'department.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'department.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'department.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Module
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'module.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'module.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'module.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'module.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialtype
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialgroup
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialgroup.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialgroup.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialgroup.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'materialgroup.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Material
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'material.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'material.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'material.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'material.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Unit
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'unit.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'unit.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'unit.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'unit.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Menupermission
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'menupermission.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'menupermission.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'menupermission.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'menupermission.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Employee
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'employee.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'employee.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'employee.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'employee.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Intype
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'intype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'intype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'intype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'intype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Outtype
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'outtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'outtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'outtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'outtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Jobstatus
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobstatus.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobstatus.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobstatus.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobstatus.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Priority
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'priority.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'priority.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'priority.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'priority.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //User
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'user.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'user.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'user.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'user.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Role
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'role.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'role.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'role.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'role.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Joborder
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'joborder.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'joborder.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'joborder.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'joborder.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'joborder.print_frm01',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'joborder.send_ap',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Receive
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'receive.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'receive.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'receive.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'receive.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Retriement
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'retirement.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'retirement.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'retirement.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'retirement.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Stock-management
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'stock-management.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'stock-management.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'stock-management.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'stock-management.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Dashboard
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'dashboard.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Log
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'log.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Report
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'report.view',
            
            'created_at' => Carbon::now(),
        ]);
    //jobtype
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobtype.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobtype.edit',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'jobtype.delete',
            
            'created_at' => Carbon::now(),
        ]);
    //Ma Approved
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'ma_approved.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'ma_approved.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'ma_approved.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'ma_approved.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 4,
        //     'code' => 'ma_approved.print_frm02',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Recovery
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'recovery.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'recovery.rollback',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 4,
            'code' => 'recovery.delete',
            
            'created_at' => Carbon::now(),
        ]);

/////////////////////////// supervisor /////////////////////////////
    
    //Department
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'department.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialtype
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'materialtype.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Materialgroup
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'materialgroup.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Material
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'material.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Unit
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'unit.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Employee
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'employee.view',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'employee.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'employee.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'employee.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Intype
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'intype.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'intype.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'intype.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'intype.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Outtype
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'outtype.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'outtype.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'outtype.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'outtype.delete',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //jobtype
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'jobtype.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Joborder
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'joborder.view',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'joborder.create',
            
            'created_at' => Carbon::now(),
        ]);
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'joborder.edit',
            
            'created_at' => Carbon::now(),
        ]);
        
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'joborder.print_frm01',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'joborder.confirm',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'joborder.send_ap',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Priority
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'priority.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Receive
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'receive.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'receive.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'receive.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
        
    //Retriement
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'retirement.view',
            
            'created_at' => Carbon::now(),
        ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'retirement.create',
            
        //     'created_at' => Carbon::now(),
        // ]);
        // RolePermission::insert([
        //     'role_id' => 2,
        //     'code' => 'retirement.edit',
            
        //     'created_at' => Carbon::now(),
        // ]);
    //Stock-management
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'stock-management.view',
            
            'created_at' => Carbon::now(),
        ]);
        
    //Dashboard
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'dashboard.view',
            
            'created_at' => Carbon::now(),
        ]);
    // //Log
    //     RolePermission::insert([
    //         'role_id' => 2,
    //         'code' => 'log.view',
            
    //         'created_at' => Carbon::now(),
    //     ]);
    //Report
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'report.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Ma Approved
        RolePermission::insert([
            'role_id' => 2,
            'code' => 'ma_approved.view',
            
            'created_at' => Carbon::now(),
        ]);
        
/////////////////////////// USER /////////////////////////////
    //Joborder
        RolePermission::insert([
            'role_id' => 3,
            'code' => 'joborder.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Dashboard
        RolePermission::insert([
            'role_id' => 3,
            'code' => 'dashboard.view',
            
            'created_at' => Carbon::now(),
        ]);
    //Report
        RolePermission::insert([
            'role_id' => 3,
            'code' => 'report.view',
            
            'created_at' => Carbon::now(),
        ]);
    }
}
