<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportUser implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Employee Id',
            'Employee Name',
            'Official Email',
            'Personal Email',
            'TL Name',
            'Mobile',
            'Address',
            'State',
            'City',
            'region',
            'branch',
            'Blood Group',
            'Qualification',
            'Experience',
            'Aadhar No',
            'status',
            'created_at',
            'Updated_at' 
        ];
    } 

    public function collection()
    {
        $users  = DB::table('users')
        ->leftjoin('users AS cd','cd.id','=','users.assign_tl')
        ->leftjoin('states','states.id','=','users.state_id')
        ->leftjoin('cities','cities.id','=','users.city_id')
        ->leftjoin('regions','regions.id','=','users.region_id')
        ->leftjoin('branches','branches.id','=','users.branch_id')
        ->leftjoin('status','status.status_id','=','users.status')
        ->where('users.role_id', '!=', '1')
        ->where('status.type',1)
        ->select('users.employee_id','users.name','users.email','users.personal_email','cd.name AS tl_name','users.mobile',
        'users.address','states.name as state_name','cities.name as city_name','regions.name AS region_name',
        'branches.name AS branch_name','users.blood_group','users.qualification','users.experience','users.aadhar_no',
        'status.name AS employee_status','users.created_at','users.updated_at');
        return $users = $users->get();
    
    }
            
}
