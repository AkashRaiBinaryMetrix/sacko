<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\AdminMenu;
use Hash;
use Validator;
use Session;

class AdminMenuController extends Controller
{
    //
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
} 
