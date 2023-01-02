<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'module_id', 'sub_module_id','can_manage', 'can_create','can_edit','can_edit','can_view','can_delete','status', 'created_by', 'updated_by','created_at','updated_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_by', 'updated_by','created_at','updated_at',
    ];
    public static function store($role_id, $request) {
        foreach ($request['module_id'] as $module) {
            $permission = 0;
            if (isset($request['sub_module_id'][$module])) {
                
                foreach ($request['sub_module_id'][$module] as $sub_module) {
                    $can_manage = 0;
                    $can_create = 0;
                    $can_edit = 0;
                    $can_view = 0;
                    $can_delete = 0;
                    if (isset($request['can_manage']) && isset($request['can_manage'][$module][$sub_module])) {
                        $can_manage = $request['can_manage'][$module][$sub_module];
                        
                    }
                    if (isset($request['can_create']) && isset($request['can_create'][$module][$sub_module])) {
                        $can_create = $request['can_create'][$module][$sub_module];
                        
                    }
                    if (isset($request['can_edit']) && isset($request['can_edit'][$module][$sub_module])) {
                        $can_edit = $request['can_edit'][$module][$sub_module];
                        
                    }
                    if (isset($request['can_view']) && isset($request['can_view'][$module][$sub_module])) {
                        $can_view = $request['can_view'][$module][$sub_module];
                        
                    }
                    if (isset($request['can_delete']) && isset($request['can_delete'][$module][$sub_module])) {
                        $can_delete = $request['can_delete'][$module][$sub_module];
                        
                    }
                    if ($can_manage) {
                        $permission = 1;
                    }
                    $reqData = [];
                    $reqData['role_id'] = $role_id;
                    $reqData['module_id'] = $module;
                    $reqData['sub_module_id'] = $sub_module;
                    $reqData['can_manage'] = $can_manage;
                    $reqData['can_create'] = $can_create;
                    $reqData['can_edit'] = $can_edit;
                    $reqData['can_view'] = $can_view;
                    $reqData['can_delete'] = $can_delete;
                    $reqData['created_by'] = auth()->user()->id;
                    $reqData['updated_by'] = auth()->user()->id;
                    self::create($reqData);
                }    
            } 
            if ($permission == 1) {
                $can_manage = 1;
                $can_create = 1;
                $can_edit = 1;
                $can_view = 1;
                $can_delete = 1;
                $reqData = [];
                $reqData['role_id'] = $role_id;
                $reqData['module_id'] = $module;
                $reqData['can_manage'] = $can_manage;
                $reqData['can_create'] = $can_create;
                $reqData['can_edit'] = $can_edit;
                $reqData['can_view'] = $can_view;
                $reqData['can_delete'] = $can_delete;
                $reqData['created_by'] = auth()->user()->id;
                $reqData['updated_by'] = auth()->user()->id;
                self::create($reqData);   
            }
        }
    }
    
    public static function deletePermissions($role_id) {
        if (is_array($role_id)) {
            return self::whereIn('role_id', $role_id)->delete();
        } else {
            return self::where('role_id', $role_id)->delete();    
        }
    }

    public function ScopeGetPermissionByRoleId($query, $role='')
    {
        return $query->where('role_id',$role)->get();//->get(['']);
    }
}
