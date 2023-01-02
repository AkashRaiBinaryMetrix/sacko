<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\ApplyLeaveController;
use App\Http\Controllers\Api\LeaveTypeController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\ClaimController;
use App\Http\Controllers\Api\HelpController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserManualController;
use App\Http\Controllers\Api\IncentiveController;
use App\Http\Controllers\Api\ResignationController;
use App\Http\Controllers\Api\TeamLeadController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\RsoSalesController;
use App\Http\Controllers\Api\MyVisitController;









/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login',[AuthController::class, 'login']);
Route::post('forgetPassword',[AuthController::class, 'forgetPassword']);
Route::post('update/profile',[AuthController::class, 'updateProfile']);
Route::get('holiday_list',[HolidayController::class, 'holiday_list']);
Route::post('apply_leave',[ApplyLeaveController::class, 'apply_leave']);
Route::get('leaveType',[LeaveTypeController::class, 'leaveType']);
Route::post('question',[QuestionController::class, 'question']);
Route::get('viewAssignedTest',[TestController::class, 'viewAssignedTest']);
//Route::post('attendance',[AttendanceController::class, 'attendance']);
Route::post('attendance/in',[AttendanceController::class, 'attendanceIn']);
Route::post('attendance/out',[AttendanceController::class, 'attendanceOut']);
Route::get('viewAttendance',[AttendanceController::class, 'viewAttendance']);
Route::post('myLeave',[LeaveTypeController::class, 'myLeave']);
Route::get('training/center',[TrainingController::class, 'training']);
Route::get('brand/list',[BrandController::class, 'getBrand']);
Route::get('category/list',[CategoryController::class, 'getCategory']);
Route::post('update/sales',[SalesController::class, 'updateSales']);
Route::post('get/sales',[SalesController::class, 'getSales']);
Route::post('sales/reason',[SalesController::class, 'salesReason']);
Route::post('claim',[ClaimController::class, 'claim']);
Route::post('get/claim',[ClaimController::class, 'getclaim']);
Route::post('save/result',[TestController::class, 'saveResult']);
Route::get('get/help',[HelpController::class, 'getHelp']);
Route::post('feedback',[FeedbackController::class, 'feedback']);
Route::get('user/manual',[UserManualController::class, 'getUserManual']);
Route::post('incentive',[IncentiveController::class, 'getIncentive']);
Route::post('resignation',[ResignationController::class, 'resignation']);
Route::post('get/resignation',[ResignationController::class, 'getResignation']);
Route::post('add/display/tracker',[ReportController::class, 'addDisplayTracker']);
Route::post('update/display/tracker',[ReportController::class, 'updateDisplayTracker']);
Route::post('get/display/tracker',[ReportController::class, 'getDisplayTracker']);
Route::post('get/sub/category',[CategoryController::class, 'getSubCategory']);
Route::get('get/states',[AuthController::class, 'getStates']);
Route::post('display/tracker/upload/store/pic',[ReportController::class, 'displayTrackerStorePic']);
Route::post('get/display/tracker/store/pic',[ReportController::class, 'getDisplayTrackerStorePic']);
Route::post('competition/display/tracker',[ReportController::class, 'competitionDisplayTracker']);
Route::post('get/competition/display/tracker',[ReportController::class, 'getCompetitionDisplayTracker']);
Route::post('tl/employee/list',[TeamLeadController::class, 'getTeamLeadEmployeeList']);
Route::post('competition/sales',[ReportController::class, 'competitionSales']);
Route::post('get/competition/sales',[ReportController::class, 'getCompetitionSales']);
Route::post('leave/approval',[LeaveTypeController::class, 'leaveApproval']);
Route::post('get/salary/slip',[SalaryController::class, 'getSalarySlip']);
Route::post('attendance/weekly',[AttendanceController::class, 'attendanceWeekly']);
Route::post('total/attendance',[AttendanceController::class, 'getTotalAttendance']);
Route::post('employee/list',[TeamLeadController::class, 'getEmployeeList']);
Route::post('tl/employee/sales/list',[SalesController::class, 'getTlEmployeeSalesList']);
Route::post('tl/attendance/update',[AttendanceController::class, 'tlAttendanceUpdate']);
Route::post('rso/sales',[RsoSalesController::class, 'rsoSales']);
Route::post('get/rso/sales',[RsoSalesController::class, 'getRsoSales']);
Route::post('get/dealer',[RsoSalesController::class, 'getDealer']);
Route::get('get/product',[RsoSalesController::class, 'getProduct']);
Route::post('get/distributor',[RsoSalesController::class, 'getDistributor']);
Route::post('my/visit',[MyVisitController::class, 'myVisitIn']);
Route::post('my/visit/out',[MyVisitController::class, 'myVisitOut']);
Route::post('get/my/visit',[MyVisitController::class, 'getMyVisit']);
Route::post('certificate',[TestController::class, 'viewCertificate']);










