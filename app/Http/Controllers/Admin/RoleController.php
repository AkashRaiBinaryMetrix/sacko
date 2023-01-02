<?php
namespace App\Http\Controllers\Admin;
use App\Models\Role;
use App\Models\AdminMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Session;

class RoleController extends Controller
{
    //
    public function index()
    {   
        $routeArray                 = app('request')->route()->getAction();
        $controllerAction           = class_basename($routeArray['controller']);
        list($controller, $action)  = explode('@', $controllerAction);
        $roles                      = Role::paginate(10);
        return view('admin.role.index',compact('controller','roles'));
    }

    public function create()
    {
        $admin_module       =AdminMenu::orderBy('id','ASC')->where('status',1)->get();
        $smenus             =$admin_module;
		$m                  =$admin_module;
		$s                  =$admin_module;
		$mains1             =explode(",",$m);
		$subs1              =explode(",",$s);
        return view('admin.role.create',compact('admin_module','subs1','mains1'));
    }

    public function store(Request $request)
    {
        $role               = New Role;	
        $role->name         = $request['name'];
        $role->role_text    = Str::slug($request['name'],'-');
        $role->status       = $request->status; 
        $role->save();
        // Create Permissions
        \App\Models\RolePermission::deletePermissions($role->id);
        \App\Models\RolePermission::store($role->id, $request);
        Session::flash('message', 'Role Created Successfully!');
        return redirect()->route('admin.role.index');
    }


    public function edit(Role $role,$id='')
    {
        if($id!='')
        {
            $admin_module   =AdminMenu::orderBy('id','ASC')->where('status',1)->get();
            $role           =Role::find($id);
            return view('admin.role.edit',compact('role','admin_module'));
        }
        return redirect()->back();
           
    }
	
    public function update(Request $request, $id)
    {
        $role               = Role::findOrFail($id);
        $role->name         = $request->name;
        $role->role_text    = Str::slug(trim($request['name']),'-');
        $role->status       = $request->status;
        $role->save();
        \App\Models\RolePermission::deletePermissions($role->id);
        \App\Models\RolePermission::store($role->id, $request);
        return redirect()->route('admin.role.index')->with('message','Role has been updated successfully!');
    }
	
    public function destroy(Request $request)
    {	
        $ids = $request->mul_del;
        \App\Models\RolePermission::deletePermissions($ids);
        Role::whereIn('id',$ids)->delete();
        Session::flash('message', 'Role Deleted Successfully !');
        return redirect()->route('admin.role.index');
    }

    public function viewpermission()    
    {   
        $roles=Role::orderBy('id','Desc')->paginate(10);;
        return view('role.permission.index')->with('roles', $roles);
    }
}
