<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\Admin\AuthController;
 use App\Http\Controllers\Admin\DashboardController;
 use App\Http\Controllers\Admin\UserController;
 use App\Http\Controllers\Admin\AdminMenuController;
 use App\Http\Controllers\Admin\RoleController;
 use App\Http\Controllers\Admin\EmployeeController;
 use App\Http\Controllers\Admin\AttendanceController;
 use App\Http\Controllers\Admin\HolidayCalendarController;
 use App\Http\Controllers\Admin\LeaveController;
 use App\Http\Controllers\Admin\LeaveTypeController;
 use App\Http\Controllers\Admin\CategoryController;
 use App\Http\Controllers\Admin\SubCategoryController;
 use App\Http\Controllers\Admin\SalaryController;
 use App\Http\Controllers\Admin\DepartmentController;
 use App\Http\Controllers\Admin\IdTypeController;
 use App\Http\Controllers\Admin\FeedbackController;



 
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


//Admin Route Start
Route::get('', [AuthController::class, 'getLogin']);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
	
	Route::get('', [AuthController::class, 'getLogin'])->name('login.get');
	Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
	
	// Protected Routes
    Route::group(['middleware' => 'auth'], function (){
    
    Route::get('dashboard', [DashboardController::class, 'getIndex'])->name('admin.dashboard');
    
    Route::any('getTodayAttendanceData', [DashboardController::class, 'getTodayAttendanceData']);
    
    Route::get('/dashboard/users/graph', [DashboardController::class, 'getUsersGraphData'])->name('admin.dashboard.users.graph');
    Route::get('logout', [UserController::class, 'logout'])->name('logout'); 

	//Start User Route
    Route::get('user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
	Route::post('user/delete',[UserController::class, 'delete']);
    Route::get('user/edit/{slug?}', [UserController::class,'edit']);
    Route::post('user/update/{slug?}', [UserController::class, 'update']);
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::post('user/updateprofile', [UserController::class, 'updateprofile']);
    Route::get('user/lastlogin/users','UserController@last_login')->name('user.lastlogin');
    Route::post('user/change-password/{slug?}',[UserController::class, 'savechangepassword']);
	
	//Start Admin Route
    Route::get('admin-menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::get('admin-menu/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
    Route::post('admin-menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
    Route::get('admin-menu/edit/{slug?}',[AdminMenuController::class, 'edit']);
    Route::post('admin-menu/update/{slug?}',[AdminMenuController::class, 'update']);
    Route::post('admin-menu/delete',[AdminMenuController::class, 'delete']);
   
    //Start Admin Route
    Route::get('role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('role/edit/{slug?}',[RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('role/update/{slug?}',[RoleController::class, 'update'])->name('admin.role.update');
    Route::post('role/delete',[RoleController::class, 'destroy'])->name('admin.role.delete');

    //Start User Route
    Route::get('user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
	Route::post('user/delete',[UserController::class, 'delete']);
    Route::get('user/edit/{slug?}', [UserController::class,'edit']);
    Route::get('user/view/{slug?}',[UserController::class, 'view']);
    Route::post('user/update/{slug?}', [UserController::class, 'update']);
    Route::get('user/profile', [UserController::class, 'profile']);
    Route::post('user/updateprofile', [UserController::class, 'updateprofile']);
    Route::get('user/lastlogin/users','UserController@last_login')->name('user.lastlogin');
    Route::post('user/change-password/{slug?}',[UserController::class, 'savechangepassword']);
    Route::post('fetch-states',[UserController::class, 'fetchState'])->name('admin.user.fetchState');
    Route::post('fetch-cities',[UserController::class, 'fetchCity'])->name('admin.user.fetchCity');
    Route::get('user/export',[UserController::class,'exportUsers'])->name('admin.user.exportUsers');

    //Start Employee Route
    Route::get('admin-employee-managerbulkpunchin',[EmployeeController::class, 'managerBulkPunchin'])->name('admin.employee.managerbulkpunchin');
    Route::get('employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::get('employee/edit/{slug?}',[EmployeeController::class, 'edit']);
    Route::post('employee/update/{slug?}',[EmployeeController::class, 'update']);
    Route::post('employee/assignUpdate',[EmployeeController::class, 'assignUpdate']);
	Route::get('employee/view/{slug?}',[EmployeeController::class, 'view']);
    Route::post('employee/delete',[EmployeeController::class, 'delete']);
    Route::post('fetch-states',[EmployeeController::class, 'fetchState'])->name('admin.employee.fetchState');
    Route::post('fetch-cities',[EmployeeController::class, 'fetchCity'])->name('admin.employee.fetchCity');
    Route::get('employee/export',[EmployeeController::class,'exportemployee'])->name('admin.employee.exportemployee');
    Route::post('subcategory-by-category', [EmployeeController::class, 'getSubCategory']);
    Route::post('employee-by-hierarchy', [EmployeeController::class, 'getHierarchy']);
    Route::get('employee-apply-leave',[EmployeeController::class, 'employeeApplyLeave'])->name('admin.employee.applyleave');
    Route::get('employee-leave-list',[EmployeeController::class, 'employeeLeaveList'])->name('admin.employee.employeeleavelist');
    Route::get('admin-employee-projectlist',[EmployeeController::class, 'adminEmployeeProjectList'])->name('admin.employee.projectlist');

    Route::get('admin-employee-leavelist',[EmployeeController::class, 'adminEmployeeLeaveList'])->name('admin.employee.leavelist');

    Route::get('employee-manage-createshift',[EmployeeController::class, 'adminManageCreateshift'])->name('admin.manage.createshift');
    Route::get('employee-manage-createshift',[EmployeeController::class, 'adminManageCreateshift'])->name('admin.manage.createshift');
    Route::get('admin-manage-shiftlisting',[EmployeeController::class, 'adminManageShiftlisting'])->name('admin.manage.shiftlisting');
    
    Route::get('admin-manage-managecreateproject',[AdminMenuController::class, 'adminManageManagecreateproject'])->name('admin.manage.managecreateproject');

    Route::get('admin-manage-managecalendarconfiguration',[AdminMenuController::class, 'adminManageManageCalendar'])->name('admin.manage.managecalendarconfiguration');

      Route::get('admin-manage-manageholidaylisting',[AdminMenuController::class, 'adminManageHolidayListing'])->name('admin.manage.manageholidaylisting');
    
    Route::get('admin-manage-managetaxconfiguration',[AdminMenuController::class, 'adminManageManageTaxConfiguration'])->name('admin.manage.managetaxconfiguration');

     Route::get('admin-manage-manageprimarybonus',[AdminMenuController::class, 'adminManageManagePrimaryBonus'])->name('admin.manage.manageprimarybonus');

    Route::get('admin-employee-managerattendancelist',[EmployeeController::class, 'managerAttendanceList'])->name('admin.employee.managerattendancelist');

    Route::get('admin-manage-hrmportal',[DashboardController::class, 'adminManageHrmportal'])->name('admin.manage.hrmportal');

    Route::get('admin-manage-manageprojectlist',[AdminMenuController::class, 'adminManageManageprojectlist'])->name('admin.manage.manageprojectlist');
    Route::post('admin-manage-saveproject',[AdminMenuController::class, 'adminManageSaveproject'])->name('admin.manage.saveproject');
    Route::get('projectlist/delete/{slug?}',[AdminMenuController::class, 'deleteProjectFromList']);
    Route::get('projectlist/edit/{slug?}',[AdminMenuController::class, 'editProjectFromList']);
    Route::post('admin-manage-updateproject',[AdminMenuController::class, 'adminManageUpdateProject'])->name('admin.manage.updateproject');

    //shift
    Route::get('admin-manage-createshift',[AdminMenuController::class, 'adminManageCreateShift'])->name('admin.manage.managecreateshift');
    Route::get('admin-manage-manageshiftlist',[AdminMenuController::class, 'adminManageShiftList'])->name('admin.manage.manageshiftlist');

    //Start Attendance Route
    Route::get('attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('admin.attendance.create');
    Route::post('attendance/store', [AttendanceController::class, 'store'])->name('admin.attendance.store');
    Route::get('attendance/edit/{slug?}',[AttendanceController::class, 'edit']);
    Route::post('attendance/update/{slug?}',[AttendanceController::class, 'update']);
    Route::get('attendance/view/{slug?}',[AttendanceController::class, 'view']);
    Route::post('attendance/delete',[AttendanceController::class, 'delete']);
    Route::get('attendance/export',[AttendanceController::class,'exportAttendance'])->name('admin.attendance.exportAttendance');
    Route::post('attendance/mark',[AttendanceController::class,'markAttendance'])->name('attendance.process');

    //Start Holiday Route
    Route::get('holiday_calendar/fullcalender', [HolidayCalendarController::class, 'fullcalender'])->name('admin.holiday_calendar.fullcalender');
    Route::get('fullcalenderAjax', [HolidayCalendarController::class, 'ajax'])->name('admin.holiday_calendar.ajax');
    Route::get('holiday_calendar/getCalender',[HolidayCalendarController::class, 'getCalender'])->name('admin.holiday_calendar.getCalender');
    Route::get('holiday_calendar/getEvents',[HolidayCalendarController::class, 'getEvents'])->name('admin.holiday_calendar.getEvents');
    Route::get('holiday_calendar/status',[HolidayCalendarController::class, 'status'])->name('admin.holiday_calendar.status');
    Route::get('holiday_calendar',[HolidayCalendarController::class, 'index'])->name('admin.holiday_calendar.index');
    Route::get('holiday_calendar/create',[HolidayCalendarController::class, 'create'])->name('admin.holiday_calendar.create');
    Route::post('holiday_calendar/store',[HolidayCalendarController::class, 'store'])->name('admin.holiday_calendar.store');
    Route::get('holiday_calendar/edit/{slug?}',[HolidayCalendarController::class, 'edit'])->name('admin.holiday_calendar.edit');
    Route::post('holiday_calendar/delete',[HolidayCalendarController::class, 'delete'])->name('admin.holiday_calendar.delete');
    Route::post('holiday_calendar/update/{slug?}',[HolidayCalendarController::class, 'update'])->name('admin.holiday_calendar.update');

    //Leave Master
    Route::get('leave/status',[LeaveController::class, 'status'])->name('admin.leave.status');
    Route::get('my-leave',[LeaveController::class, 'my_leave'])->name('admin.leave.my_leave');
    Route::get('leave',[LeaveController::class, 'index'])->name('admin.leave.index');
    Route::post('leave/store',[LeaveController::class, 'store'])->name('admin.leave.store');
    Route::get('leave/edit/{slug?}',[LeaveController::class, 'edit'])->name('admin.leave.edit');
    Route::post('leave/delete',[LeaveController::class, 'delete']);
    Route::post('leave/update/{slug?}',[LeaveController::class, 'update'])->name('admin.leave.update');
    Route::get('leave/view/{slug?}',[LeaveController::class, 'view']);
    Route::get('leave/export',[LeaveController::class,'exportLeave']);

    //Leave Type Master
    Route::get('leavetype',[LeaveTypeController::class, 'index'])->name('admin.leavetype.index');
    Route::post('leavetype/store',[LeaveTypeController::class, 'store'])->name('admin.leavetype.store');
    Route::get('leavetype/edit/{slug?}',[LeaveTypeController::class, 'edit'])->name('admin.leavetype.edit');
    Route::post('leavetype/delete',[LeaveTypeController::class, 'destroy'])->name('admin.leavetype.destroy');
    Route::post('leavetype/update/{slug?}',[LeaveTypeController::class, 'update'])->name('admin.leavetype.update');

    //Start Category Route
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/edit/{slug?}',[CategoryController::class, 'edit']);
    Route::post('category/update/{slug?}',[CategoryController::class, 'update']);
	Route::get('category/view/{slug?}',[CategoryController::class, 'view']);
    Route::post('category/delete',[CategoryController::class, 'delete']);

    //Start Sub Category Route
    Route::get('sub_category', [SubCategoryController::class, 'index'])->name('admin.sub_category.index');
    Route::get('sub_category/create', [SubCategoryController::class, 'create'])->name('admin.sub_category.create');
    Route::post('sub_category/store', [SubCategoryController::class, 'store'])->name('admin.sub_category.store');
    Route::get('sub_category/edit/{slug?}',[SubCategoryController::class, 'edit']);
    Route::post('sub_category/update/{slug?}',[SubCategoryController::class, 'update']);
	Route::get('sub_category/view/{slug?}',[SubCategoryController::class, 'view']);
    Route::post('sub_category/delete',[SubCategoryController::class, 'delete']);
  
    //Start Salary Route
    Route::get('salary', [SalaryController::class, 'index'])->name('admin.salary.index');
    Route::get('salary/create', [SalaryController::class, 'create'])->name('admin.salary.create');
    Route::post('salary/store', [SalaryController::class, 'store'])->name('admin.salary.store');
    Route::get('salary/edit/{slug?}',[SalaryController::class, 'edit']);
    Route::post('salary/update/{slug?}',[SalaryController::class, 'update']);
    Route::get('salary/view/{slug?}',[SalaryController::class, 'view']);
    Route::post('salary/delete',[SalaryController::class, 'delete']);
    Route::get('salary/import', [SalaryController::class, 'getImport'])->name('admin.salary.getImport');
    Route::post('salary/import_store',[SalaryController::class, 'import']);
    Route::get('salary/export',[SalaryController::class,'exportSalary']);

    //Start Feedback Route
    Route::get('feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('feedback/view/{slug?}',[FeedbackController::class, 'view']);
    Route::post('feedback/delete',[FeedbackController::class, 'destroy'])->name('admin.feedback.delete');

    //Start Department Route
    Route::get('department', [DepartmentController::class, 'index'])->name('admin.department.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    Route::post('department/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::get('department/edit/{slug?}',[DepartmentController::class, 'edit']);
    Route::post('department/update/{slug?}',[DepartmentController::class, 'update']);
	Route::get('department/view/{slug?}',[DepartmentController::class, 'view']);
    Route::post('department/delete',[DepartmentController::class, 'delete']);

    //Start Id Type Route
    Route::get('id_type', [IdTypeController::class, 'index'])->name('admin.id_type.index');
    Route::get('id_type/create', [IdTypeController::class, 'create'])->name('admin.id_type.create');
    Route::post('id_type/store', [IdTypeController::class, 'store'])->name('admin.id_type.store');
    Route::get('id_type/edit/{slug?}',[IdTypeController::class, 'edit']);
    Route::post('id_type/update/{slug?}',[IdTypeController::class, 'update']);
	Route::get('id_type/view/{slug?}',[IdTypeController::class, 'view']);
    Route::post('id_type/delete',[IdTypeController::class, 'delete']);










	});
});
