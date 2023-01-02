<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportEmployee implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Employee Id',
            'Employee Name',
            'Email',
            'Mobile',
            'Address',
            'State',
            'City',
            'status',
            'created_at',
            'Updated_at' 
        ];
    } 

    public function collection()
    {
        $users  = DB::table('users')
        ->leftjoin('states','states.id','=','users.state_id')
        ->leftjoin('cities','cities.id','=','users.city_id')
        ->leftjoin('status','status.status_id','=','users.status')
        ->where('users.role_id', '!=', '1')
        ->where('status.type',1)
        ->select('users.employee_id','users.first_name','users.email','users.mobile',
        'users.home_address','states.name as state_name','cities.name as city_name',
        'status.name AS employee_status','users.created_at','users.updated_at');
        return $users = $users->get();
    
    }
}
