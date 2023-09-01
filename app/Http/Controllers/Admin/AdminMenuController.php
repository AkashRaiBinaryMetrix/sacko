<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\AdminMenu;
use \App\Models\User;
use Hash;
use Auth;
use Validator;
use Session;
use DB;

class AdminMenuController extends Controller
{
    public static function userMenus($role)
	{
		$menus=AdminMenu::where('status','1')->orderBy('priority','ASC')->get();
       
        $user=User::where('id',Auth::user()->id)->first();
		Session::put('menus',$menus);
	}

    public function index()
    {  
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        return view('admin.menu.index', compact(['menus', 'datacountlists','parent_menus']));
    }

    public function create()
    {
        $parent_menus          = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        return view('admin.menu.create',compact('parent_menus'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
                                                'name' => 'required',
                                                'url' => 'required',
                                                //'icon' => 'required',
                                                'parent_menu_id' => 'required',
                                                'status' => 'required',
                                                'priority' => 'required',
                                            ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {   
            $menu                   = new AdminMenu();
            $menu->name             = $request['name'];
            $menu->url              = $request['url'];
            $menu->icon             = $request['icon'];
            $menu->parent_menu_id   = $request['parent_menu_id'];
            $menu->status           = $request['status'];
            $menu->priority         = $request['priority'];		
            $menu->save();
            Session::flash('message', 'Menu Successfully created !');
            return redirect('admin/admin-menu/');
        }
    }

    public function edit(Request $request, $id='')
    {
        $menu                   = AdminMenu::find($id); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->where('id','!=',$menu->id)->get(); 


        return view('admin.menu.edit', compact(['menu','parent_menus']));
    }

    public function editHolidayList(Request $request, $id=''){
        $menu                   = AdminMenu::find($id); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->where('id','!=',$menu->id)->get(); 
        $id = Auth::user()->id;
        $categories             = DB::table('categories')->get();
        $holiday_list = DB::table('holiday_list')->where('id','=',$id)->get();

        return view('admin.payroll.editHolidayRecord', compact(['menu','parent_menus','categories','holiday_list']));
    }

    public function editSecondryBonus(Request $request, $id=''){
        $menu                   = AdminMenu::find($id); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->where('id','!=',$menu->id)->get(); 
        $id = Auth::user()->id;
        $categories             = DB::table('categories')->get();

        $holiday_list = DB::table('secondry_bonus')->where('id','=',$id)->get();

        return view('admin.payroll.editSecondryRecord', compact(['menu','parent_menus','categories','holiday_list']));
    }

    public function editPrimaryBonus(Request $request, $id=''){
        $menu                   = AdminMenu::find($id); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->where('id','!=',$menu->id)->get(); 
        $id = Auth::user()->id;
        $categories             = DB::table('categories')->get();
        $holiday_list = DB::table('primary_bonus')->where('id','=',$id)->get();

        return view('admin.payroll.editPrimaryBonus', compact(['menu','parent_menus','categories','holiday_list']));
    }

    public function update(Request $request, $id)
	{	
		$v = Validator::make($request->all(), [
                                                'name' => 'required',
                                                'url' => 'required',
                                                //'icon' => 'required',
                                                'parent_menu_id' => 'required',
                                                'status' => 'required',
                                                'priority' => 'required',
                                            ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
		{	
			try 
			{
				$menu	                = AdminMenu::where('id',$id)->first();
                $menu->name             = $request['name'];
                $menu->url              = $request['url'];
                $menu->icon             = $request['icon'];
                $menu->parent_menu_id   = $request['parent_menu_id'];
                $menu->status           = $request['status'];
                $menu->priority         = $request['priority'];
				$menu->save();	
				Session::flash('message', 'Menu updated Successfully!');
				return back();
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/admin-menu/update/'.$id.'')->withInput($request->input())->withErrors(array('message' => $message));
			}
		}
	}

    public function delete(Request $request,$id='')
    {
        $ids = $request->mul_del;
        AdminMenu::whereIn('id',$ids)->delete();
        Session::flash('message', 'Menu Deleted Successfully !');
        return redirect('admin/admin-menu/');
    }

    public function adminManageManagecreateproject(Request $request){
        $id = Auth::user()->id;
        $countries         = \App\Models\Country::get(["name", "id"]);
        $states         = \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities         = \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 


        return view('admin.project.createproject', compact(['countries', 'states', 'cities','menus', 'datacountlists','parent_menus']));
    }

    public function adminManageSaveproject(Request $request){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        $countries         = \App\Models\Country::get(["name", "id"]);
        $states         = \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities         = \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);

        $project_title = $request->project_title;
        $project_owner = $request->project_owner;
        $project_description = $request->project_description;
        $project_type = $request->project_type;
        $distance = $request->distance;
        $material = $request->material;
        $pointA = $request->pointA;
        $pointB = $request->pointB;
        $loading_point = $request->loading_point;
        $dumping_point = $request->dumping_point;
        $project_duration = $request->project_duration;
        $material2 = $request->material2;
        $emperical_density = $request->emperical_density;
        $lab_density = $request->lab_density;
        $Country = $request->Country;
        $State = $request->State;
        $City = $request->City;
        $site_name = $request->site_name;
        $site_manager = $request->site_manager;
        $Project_Manager = $request->Project_Manager;
        $day_work_hours = $request->day_work_hours;
        $Number_of_Shifts = $request->Number_of_Shifts;
 
        DB::table('projects')->insert(
             array(
                    'created_by'     => $id,
                    'title'          => $project_title,
                    'owner'          => $project_owner,
                    'descr'          => $project_description,
                    'type' => $project_type,
                    'distance' => $distance,
                    'material' => $material,
                    'pointA' => $pointA,
                    'pointB' => $pointB,
                    'loading_point' => $loading_point,
                    'dumping_point' => $dumping_point,
                    'project_duration' => $project_duration,
                    'material2' => $material2,
                    'emperical_density' => $emperical_density,
                    'lab_density' => $lab_density,
                    'Country' => $Country,
                    'State' => $State,
                    'City' => $City,
                    'site_name' => $site_name,
                    'site_manager' => $site_manager,
                    'Project_Manager' => $Project_Manager,
                    'day_work_hours' => $day_work_hours,
                    'Number_of_Shifts' => $Number_of_Shifts
             )
        );

         return view('admin.project.createproject', compact(['countries', 'states', 'cities','menus', 'datacountlists','parent_menus']));
         
        // return view('admin.project.createproject', compact(['menus', 'datacountlists','parent_menus']));
    }

    public function adminManageManageprojectlist(){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 

        //get project details
        $datacountlists = DB::table('projects')->get();

        $projectlist    = DB::table('projects')->get();

        return view('admin.project.projectlist', compact(['menus', 'datacountlists','parent_menus','projectlist']));
    }

    public function deleteProjectFromList(Request $request, $uid=''){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();

        $deleteId = $uid;
        DB::table('projects')->delete($deleteId);

        //get project details
        $datacountlists = DB::table('projects')->get();

        $projectlist    = DB::table('projects')->get();

        return view('admin.project.projectlist', compact(['menus', 'datacountlists','parent_menus','projectlist']));
    }

    public function editProjectFromList(Request $request, $uid=''){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();

        $projectlist    = DB::table('projects')->where("id","=",$uid)->first();

        $countries         = \App\Models\Country::get(["name", "id"]);
        $states         = \App\Models\State::where("country_id",$request->country_id)->get(["name", "id"]);
        $cities         = \App\Models\City::where("state_id",$request->state_id)->get(["name", "id"]);

        return view('admin.project.editproject', compact(['countries', 'states', 'cities','menus', 'datacountlists','parent_menus','projectlist']));
    }

    public function adminManageUpdateProject(Request $request){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();

        $project_title = $request->project_title;
        $project_owner = $request->project_owner;
        $project_description = $request->project_description;
        $uid = $request->record_id;

        DB::table('projects')
        ->where('id', $uid)  // find your user by their email
        ->update(   array(
                    'title'          => $project_title,
                    'owner'          => $project_owner,
                    'descr'          => $project_description,
             ));  // update the record in the DB. 

        $projectlist    = DB::table('projects')->where("id","=",$uid)->first();

        return view('admin.project.editproject', compact(['menus', 'datacountlists','parent_menus','projectlist']));
    }

    public function adminManageShiftList(){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 

        //get project details
        $datacountlists = DB::table('usershifts')->get();

        $projectlist    = DB::table('usershifts')->get();

        return view('admin.shift.shiftlist', compact(['menus', 'datacountlists','parent_menus','projectlist']));
    }

    public function adminManageCreateShift(){
        $id = Auth::user()->id;
        $datacountlists         = AdminMenu::get();
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        return view('admin.shift.createshift', compact(['menus', 'datacountlists','parent_menus']));
    }

    public function adminManageManageCalendar(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        $categories             = DB::table('categories')->get();

        return view('admin.payroll.managecalendarconfiguration', compact(['menus','parent_menus','categories']));
    }

    public function adminManageSaveCalendar(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        $categories             = DB::table('categories')->get();

        DB::table('holiday_list')->insert(
             array(
                    'date_selection'     => $request->date_selection,
                    'holiday_name'       => $request->holiday_name,
                    'holiday_status'     => $request->holiday_status,
                    'applicable_for'     => $request->applicable_for,
                    'employee_category'  => implode(', ', $request->employee_category)
             )
        );

        Session::flash('message', 'Record Successfully created !');

        return view('admin.payroll.managecalendarconfiguration', compact(['menus','parent_menus','categories']));
    }



    public function adminManageManageTaxConfiguration(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10); 
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get(); 
        $categories             = DB::table('categories')->get();

        return view('admin.payroll.managetaxconfiguration', compact(['menus','parent_menus','categories']));
    }

    public function adminManageHolidayListing(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();

        $holiday_list            = DB::table('holiday_list')->get();

        return view('admin.payroll.adminmanageholidaylisting', compact(['menus','parent_menus','categories','holiday_list']));
    }

    public function adminManageUpdateHoliday(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        
        $categories             = DB::table('categories')->get();

        DB::table('holiday_list')
        ->where('id', $request->record_id)  // find your user by their email
        ->update(
                    array(
                        'date_selection'     => $request->date_selection,
                        'holiday_name'       => $request->holiday_name,
                        'holiday_status'     => $request->holiday_status,
                        'applicable_for'     => $request->applicable_for,
                        'applicable_for'     => '',
                        'employee_category'  => implode(', ', $request->employee_category)
                    )
                );

        $holiday_list = DB::table('holiday_list')->where('id','=',$request->record_id)->get();

        Session::flash('message', 'Record Successfully updated !');

        return view('admin.payroll.editHolidayRecord', compact(['menus','parent_menus','categories','holiday_list']));
    }

    public function adminManageUpdatePrimaryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        
        $categories             = DB::table('categories')->get();

        DB::table('primary_bonus')
        ->where('id', $request->record_id)  // find your user by their email
        ->update(
                    array(
                        'bonus_name'       => $request->bonus_name,
                        'percentage_of_basic_salary'     => $request->percentage_of_basic_salary,
                        'applicable_for'     => 0,
                        'employee_category'  => implode(', ', $request->employee_category)
                    )
                );

        $holiday_list = DB::table('primary_bonus')->where('id','=',$request->record_id)->get();

        Session::flash('message', 'Record Successfully updated !');

        return view('admin.payroll.editPrimaryBonus', compact(['menus','parent_menus','categories','holiday_list']));
    }

    public function adminManageUpdateSecondryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        
        $categories             = DB::table('categories')->get();

        DB::table('secondry_bonus')
        ->where('id', $request->record_id)  // find your user by their email
        ->update(
                    array(
                        'bonus_name'       => $request->bonus_name,
                        'percentage_of_basic_salary'     => $request->percentage_of_basic_salary,
                        'applicable_for'     => 0,
                        'employee_category'  => implode(', ', $request->employee_category)
                    )
                );

        $holiday_list = DB::table('secondry_bonus')->where('id','=',$request->record_id)->get();

        Session::flash('message', 'Record Successfully updated !');

        return view('admin.payroll.editSecondryRecord', compact(['menus','parent_menus','categories','holiday_list']));
    }

    
    public function adminManageManagePrimaryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();

        return view('admin.payroll.adminmanageprimarybonus', compact(['menus','parent_menus','categories']));
     }

     public function adminManageManageSecondryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();

        return view('admin.payroll.adminmanagesecondrybonus', compact(['menus','parent_menus','categories']));
     }

     public function adminSavePrimaryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();

        DB::table('primary_bonus')->insert(
             array(
                    'bonus_name'                       => $request->bonus_name,
                    'percentage_of_basic_salary'       => $request->percentage_of_basic_salary,
                    'applicable_for'                   => $request->applicable_for,
                    'employee_category'  => implode(', ', $request->employee_category)
             )
        );

        Session::flash('message', 'Record Successfully created !');

        return view('admin.payroll.adminmanageprimarybonus', compact(['menus','parent_menus','categories']));
     }

     public function adminSaveSecondryBonus(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();

        DB::table('secondry_bonus')->insert(
             array(
                    'bonus_name'                       => $request->bonus_name,
                    'percentage_of_basic_salary'       => $request->percentage_of_basic_salary,
                    'applicable_for'                   => 0,
                    'employee_category'  => implode(', ', $request->employee_category),
                    'status' => 0
             )
        );

        Session::flash('message', 'Record Successfully created !');

        return view('admin.payroll.adminmanagesecondrybonus', compact(['menus','parent_menus','categories']));
     }

     public function adminManageManageSalaryAdmin(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();
        $employeeList           = DB::table('users')->where("role_id",3)->get();
        $projectList            = DB::table('projects')->get();

        return view('admin.payroll.adminmanagesalaryadmin', compact(['menus','parent_menus','categories','employeeList','projectList']));
    }

    public function manageAdvancepaymentPage(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();
        $employeeList           = DB::table('users')->where("role_id",3)->get();
        $projectList            = DB::table('projects')->get();

        return view('admin.payroll.manageAdvancepaymentPage', compact(['menus','parent_menus','categories','employeeList','projectList']));
    }



    public function adminManageSaveSalaryAdmin(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();
        $employeeList           = DB::table('users')->where("role_id",3)->get();
        $projectList            = DB::table('projects')->get();
        
         DB::table('save_salary')->insert(
             array(
                    'emp_name'                       => $request->employee_name_fill,
                    'emp_id'                         => $request->employee_name_fill,
                    'project_id'                     => $request->project_id,
                    'proposed_salary'                => "",
                    'currency'                       => $request->currency,
                    'employee_rate'                  => "",
                    'monthly_hour'                   => $request->monthly_hour,
                    'hourly_hour'                    => $request->hourly_hour,
                    'basic_salary'                   => $request->basic_salary,
                    'prime_sal'                      => $request->prime_sal,
                    'prime_rent'                     => $request->prime_rent
             )
        );

        Session::flash('message', 'Record Successfully created !');

        return view('admin.payroll.adminmanagesalaryadmin', compact(['menus','parent_menus','categories','employeeList','projectList']));  
    }

     public function adminManageManageSalaryListing(Request $request){
        $id = Auth::user()->id;
        $menus                  = AdminMenu::select('*')->paginate(10);
        $parent_menus           = AdminMenu::select('id','name')->where('parent_menu_id',0)->get();
        $categories             = DB::table('categories')->get();
        $employeeList           = DB::table('users')->where("role_id",3)->get();
        $projectList            = DB::table('projects')->get();

        $salaryList            = DB::table('save_salary')->get();

        return view('admin.payroll.adminmanagesalarylisting', compact(['menus','parent_menus','categories','employeeList','projectList','salaryList']));
    }
    
} 