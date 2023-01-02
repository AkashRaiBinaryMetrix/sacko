<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportLeave implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Employee Id',
            'Employee Name',
            'Leave Type',
            'From Date',
            'To Date',
            'Approved By',
            'Status',
            'Created_at',
            'Updated_at' 
        ];
    }

    public function collection()
    {
        $leaves  = DB::table('leaves')
        ->leftjoin('users','users.id','=','leaves.user_id')
        ->leftjoin('users AS cd','cd.id','=','leaves.tl_id')
        ->leftjoin('leave_types','leave_types.id','=','leaves.leave_type_id')
        ->leftjoin('status','status.status_id','=','leaves.status')
        ->where('status.type',2)
        ->select('users.employee_id','users.name AS user_name','leave_types.name AS leave_type',
        'leaves.from_date','leaves.to_date','cd.name AS tl_name','status.name AS employee_status',
        'leaves.created_at','leaves.updated_at');
        return $leaves = $leaves->get();
    }
}
