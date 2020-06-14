<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
Route::get('/', function () {return redirect('dashboard');});
Route::group(['middleware' => ['checkPermission:company.view']], function () {
    Route::get('/home', function () {return redirect('dashboard');});
});

///////////////////////// checkPermission /////////////////////////
Route::group(['middleware' => ['checkPermission:joborder.view']], function () {
    Route::resource('joborder', 'JobOrderController');
});
Route::group(['middleware' => ['checkPermission:ma_approved.view']], function () {
    Route::resource('ma_approved', 'Ma_approvedController');
});
Route::group(['middleware' => ['checkPermission:stock-management.view']], function () {
    Route::resource('m_stock', 'M_StockController');
});
Route::group(['middleware' => ['checkPermission:dashboard.view']], function () {
    Route::resource('dashboard', 'DashboardController' );
});
Route::group(['middleware' => ['checkPermission:retirement.view']], function () {
    Route::resource('retire', 'RetireController' );
});
Route::group(['middleware' => ['checkPermission:receive.view']], function () {
    Route::resource('receive', 'ReceiveController' );
});
Route::group(['middleware' => ['checkPermission:priority.view']], function () {
    Route::resource('priority', 'PriorityController' );
});
Route::group(['middleware' => ['checkPermission:requester.view']], function () {
    Route::resource('requester', 'RequesterController' );
});
Route::group(['middleware' => ['checkPermission:employee.view']], function () {
    Route::resource('employee', 'EmployeeController' );
});
Route::group(['middleware' => ['checkPermission:asset.view']], function () {
    Route::resource('asset', 'AssetController' );
});
Route::group(['middleware' => ['checkPermission:assetmodel.view']], function () {
    Route::resource('assetmodel', 'AssetmodelController' );
});
Route::group(['middleware' => ['checkPermission:assetgroup.view']], function () {
    Route::resource('assetgroup', 'AssetgroupController' );
});
Route::group(['middleware' => ['checkPermission:checkinstatus.view']], function () {
    Route::resource('checkinstatus', 'CheckinstatusController' );
});
Route::group(['middleware' => ['checkPermission:jobstatus.view']], function () {
    Route::resource('jobstatus', 'JobstatusController' );
});
Route::group(['middleware' => ['checkPermission:outtype.view']], function () {
    Route::resource('outtype', 'OuttypeController' );
});
Route::group(['middleware' => ['checkPermission:jobtype.view']], function () {
    Route::resource('jobtype', 'JobtypeController' );
});
Route::group(['middleware' => ['checkPermission:intype.view']], function () {
    Route::resource('intype', 'IntypeController' );
});
Route::group(['middleware' => ['checkPermission:department.view']], function () {
    Route::resource('department', 'DepartmentController' );
});
Route::group(['middleware' => ['checkPermission:branch.view']], function () {
    Route::resource('branch', 'BranchController' );
});
Route::group(['middleware' => ['checkPermission:businessunit.view']], function () {
    Route::resource('businessunit', 'BusinessunitController' );
});
Route::group(['middleware' => ['checkPermission:company.view']], function () {
    Route::resource('company', 'CompanyController' );
});
Route::group(['middleware' => ['checkPermission:docnumber.view']], function () {  
    Route::resource('docnumber', 'DocnumberController' );
});
Route::group(['middleware' => ['checkPermission:location.view']], function () {
    Route::resource('location', 'LocationController' );
});
Route::group(['middleware' => ['checkPermission:material.view']], function () {
    Route::resource('material', 'MaterialController' );
});
Route::group(['middleware' => ['checkPermission:unit.view']], function () {
    Route::resource('unit', 'UnitController' );
});
Route::group(['middleware' => ['checkPermission:materialgroup.view']], function () {
    Route::resource('materialgroup', 'MaterialGroupController' );
});
Route::group(['middleware' => ['checkPermission:materialtype.view']], function () {
    Route::resource('materialtype', 'Material_typeController' );
});
Route::group(['middleware' => ['checkPermission:recovery.view']], function () {
    Route::resource('recovery', 'RecoveryController' );
});
Route::group(['middleware' => ['checkPermission:module.view']], function () {
    Route::resource('module', 'ModuleController' );
});
Route::group(['middleware' => ['checkPermission:menupermission.view']], function () {
    Route::resource('menu', 'MenuController' );
});
Route::group(['middleware' => ['checkPermission:log.view']], function () {
    Route::resource('log', 'LogController' );
});
Route::group(['middleware' => ['checkPermission:report.view']], function () {
    Route::resource('report', 'ReportController');
});
Route::group(['middleware' => ['checkPermission:user.view']], function () {
    Route::resource('user', 'UserController' );
});
Route::group(['middleware' => ['checkPermission:role.view']], function () {
    Route::resource('role', 'RoleController' );
});
///////////////////////// checkPermission /////////////////////////


// Route Change Password 
Route::post('changepassword', 'UserController@changepassword')->name('changepassword'); 
// End

Route::get('reportSearch', 'ReportController@reportSearch');
Route::any('jobordercreate', 'JobOrderController@create');
Route::any('joborderheadcreate', 'JobOrderController@create');

Route::any('ma_approvedcreate', 'Ma_approvedController@create');
Route::any('ma_approvededit', 'Ma_approvedController@edit');
Route::any('joborder/{request}/search', 'JobOrderController@searchResult');
Route::post('joborder/{request}/delete', 'JobOrderController@deletedetail');
Route::any('jobordercreate', 'JobOrderController@create');
Route::any('joborderedit', 'JobOrderController@edit');
// Route::any('joborderupdate', 'JobOrderController@update');
Route::any('retirecreate', 'RetireController@create');
Route::any('retire/{request}/search', 'RetireController@searchResult');
Route::post('retire/{request}/delete', 'RetireController@deletedetail');
Route::any('receivecreate', 'ReceiveController@create');
Route::any('receive/{request}/search', 'ReceiveController@searchResult');
Route::post('receive/{request}/delete', 'ReceiveController@deletedetail');
Route::post('priority_getdata', 'PriorityController@getdata')->name('priority_getdata'); 
Route::post('requester_getdata', 'RequesterController@getdata')->name('requester_getdata'); 
Route::post('employee_getdata', 'EmployeeController@getdata')->name('employee_getdata'); 
Route::post('log_getdata', 'LogController@getdata')->name('log_getdata'); 
Route::post('recover_getdata', 'RecoveryController@getdata')->name('recover_getdata'); 
Route::post('material_getdata', 'MaterialController@getdata')->name('material_getdata'); 
Route::post('m_stock_getdata', 'M_StockController@getdata')->name('m_stock_getdata'); 
Route::post('ma_approved_getdata', 'Ma_approvedController@getdata')->name('ma_approved_getdata'); 
// Component Route
Route::get('/get_branch_from_com/{comid}', 'ComponentController@get_branch_from_com')->name('get_branch_from_com'); 
Route::get('/get_dep_from_branch/{branchid}', 'ComponentController@get_dep_from_branch')->name('get_dep_from_branch'); 
Route::get('/get_material', 'ComponentController@get_material')->name('get_material'); 
Route::get('/get_emp_from_branch/{branchid}', 'ComponentController@get_emp_from_branch')->name('get_emp_from_branch');
Route::get('/get_material_type/{m_g_id}', 'ComponentController@get_material_type')->name('get_material_type');
Route::get('/get_mg_from_material/{m_t_id}', 'ComponentController@get_mg_from_material')->name('get_mg_from_material');
Route::get('/get_job_order/{branchid}', 'ComponentController@get_job_order')->name('get_job_order'); 
Route::get('/get_count_min_material', 'ComponentController@get_count_min_material')->name('get_count_min_material'); 
Route::post('/get_min_material_list', 'ComponentController@get_min_material_list')->name('get_min_material_list'); 

// End Component Route
Route::get('/dashboard2', 'DashboardController@dashboard2')->name('dashboard2'); 
Route::post('dashboard_getdataoutstock', 'DashboardController@getdataoutstock')->name('dashboard_getdataoutstock'); 
Route::post('dashboard_getdatajoborder', 'DashboardController@getdatajoborder')->name('dashboard_getdatajoborder');
Route::post('dashboard2_getdata', 'DashboardController@dashboard2_getdata')->name('dashboard2_getdata');
Route::post('receive_getdata', 'ReceiveController@getdata')->name('receive_getdata'); 
Route::post('retire_getdata', 'RetireController@getdata')->name('retire_getdata'); 
Route::post('assetgroup_getdata', 'AssetgroupController@getdata')->name('assetgroup_getdata'); 
Route::post('assetmodel_getdata', 'AssetmodelController@getdata')->name('assetmodel_getdata'); 
Route::post('asset_getdata', 'AssetController@getdata')->name('asset_getdata'); 
Route::post('businessunit_getdata', 'BusinessunitController@getdata')->name('businessunit_getdata'); 
Route::post('branch_getdata', 'BranchController@getdata')->name('branch_getdata'); 
Route::post('checkinstatus_getdata', 'CheckinstatusController@getdata')->name('checkinstatus_getdata');
Route::post('company_getdata', 'CompanyController@getdata')->name('company_getdata'); 
Route::post('department_getdata', 'DepartmentController@getdata')->name('department_getdata'); 
Route::post('docnumber_getdata', 'DocnumberController@getdata')->name('docnumber_getdata'); 
Route::post('intype_getdata', 'IntypeController@getdata')->name('intype_getdata'); 
Route::post('jobstatus_getdata', 'JobstatusController@getdata')->name('jobstatus_getdata'); 
Route::post('jobtype_getdata', 'JobtypeController@getdata')->name('jobtype_getdata'); 
Route::post('location_getdata', 'LocationController@getdata')->name('location_getdata'); 
Route::post('materialgroup_getdata', 'MaterialGroupController@getdata')->name('materialgroup_getdata');
Route::post('materialtype_getdata', 'Material_typeController@getdata')->name('materialtype_getdata');
Route::post('menu_getdata', 'MenuController@getdata')->name('menu_getdata');
Route::post('module_getdata', 'ModuleController@getdata')->name('module_getdata');
Route::post('outtype_getdata', 'OuttypeController@getdata')->name('outtype_getdata');
Route::post('unit_getdata', 'UnitController@getdata')->name('unit_getdata');
Route::post('joborder_getdata', 'JobOrderController@getdata')->name('joborder_getdata');
Route::post('joborder_getlocation', 'JobOrderController@getlocation')->name('joborder_getlocation');
Route::post('joborder_getrequest_by', 'JobOrderController@getrequest_by')->name('joborder_getrequest_by');
Route::post('joborder_getassign_as', 'JobOrderController@getassign_as')->name('joborder_getassign_as');
Route::post('joborder_getassignee', 'JobOrderController@getassignee')->name('joborder_getassignee');
Route::post('joborder_getmaterial', 'JobOrderController@getmaterial')->name('joborder_getmaterial');
Route::post('joborder_getasset', 'JobOrderController@getasset')->name('joborder_getasset');
Route::post('receive_getmaterial', 'ReceiveController@getmaterial')->name('receive_getmaterial');
Route::post('receive_getasset', 'ReceiveController@getasset')->name('receive_getasset');
Route::post('retire_getmaterial', 'RetireController@getmaterial')->name('retire_getmaterial');
Route::post('retire_getasset', 'RetireController@getasset')->name('retire_getasset');
Route::post('ma_approved_getapproved_by', 'Ma_approvedController@getapproved_by')->name('ma_approved_getapproved_by');

Route::any('joborder/{request}/print_frm01', 'JobOrderController@print_frm01');
Route::any('ma_approved/{request}/print_frm02', 'Ma_approvedController@print_frm02');
Route::post('joborder/{request}/sendtoapproved', 'JobOrderController@sendtoapproved');
Route::post('phonebook_getdata', 'PhonebookController@phonebook_getdata')->name('phonebook_getdata');
Route::any('/checkemail/{email}', 'UserController@checkEmail');
// Route::get('empinsert', 'empController@create')->name('empinsert');

// Route::any('/role/edit/{id}', 'roleController@edit')->name('role_edit');


Route::post('log_getdata', 'LogController@getdata')->name('log_getdata'); //DataTable
// Route::resource('user', 'UserController' );
Route::post('user_getdata', 'UserController@getdata')->name('user_getdata'); 

});

















