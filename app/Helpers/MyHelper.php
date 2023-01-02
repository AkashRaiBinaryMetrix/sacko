<?php
use App\Models\RolePermission;

if (!function_exists('array_from_post')) 
{
    function arrayFromPost($fieldArr = [])
    {
        $request = request();
        $output = new \stdClass;
        if (count($fieldArr)) {
            foreach ($fieldArr as $value) {
                $output->$value = $request->input($value);
            }
        }
        return $output;
    }
}

function permissions($role_id,$module_id,$sub_module_id)
{
    if(!empty($sub_module_id))
    {
        $permissions = RolePermission::where('role_id',$role_id)->where('module_id',$module_id)->where('sub_module_id',$sub_module_id)->first();
    }
    else
    {
        $permissions = RolePermission::where('role_id',$role_id)->where('module_id',$module_id)->WhereNull('sub_module_id')->first();
    }
    return $permissions;
}


function getMenu($role_id)
{	
	$permissions 		= DB::table('role_permissions')
						  ->join('admin_menus','admin_menus.id','=','role_permissions.module_id')
						  ->where('role_permissions.role_id',$role_id)
						  ->where('role_permissions.can_manage',1)
						  ->WhereNull('role_permissions.sub_module_id')
						  ->select('role_permissions.*','admin_menus.name','admin_menus.url','admin_menus.icon')
						  ->orderBy('admin_menus.priority','Asc')->get();
    return $permissions;
}

function getSubMenu($role_id,$module_id)
{
	$permissions 		= DB::table('role_permissions')
						  ->join('admin_menus','admin_menus.id','=','role_permissions.sub_module_id')
						  ->where('role_permissions.role_id',$role_id)
						  ->where('module_id',$module_id)
						  ->where('role_permissions.can_manage',1)
						  ->whereNotNull('role_permissions.sub_module_id')
						  ->select('role_permissions.*','admin_menus.name','admin_menus.url','admin_menus.icon')
						  ->orderBy('admin_menus.priority','Asc')->get();
    return $permissions;
}

if (!function_exists('getDaysBetweenDates')) {
    function getDaysBetweenDates($startDate, $endDate, $format = 'Y-m-d')
    {
        $response = [];
        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $response[] = $date->format($format);
        }
        //dd($response);
        return $response;
    }
}

if (!function_exists('getRandomNumber')) {
    function getRandomNumber($digits = 6)
    {
        return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    }
}

if (!function_exists('generateEmployeeId')) {
    function generateEmployeeId()
    {
        return 'SACKO' . getRandomNumber(5);
    }
}


