<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportAttendance implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            //'Id',
            'Employee Name',
            'Punch In',
            'Punch Out',
            'Status',
            'latitude',
            'longitude',
            'Created_at',
            'Updated_at' 
        ];
    } 

    public function collection()
    {
        $attendances  = DB::table('attendances')
        ->leftjoin('users','users.id','=','attendances.user_id')
        ->leftjoin('status','status.status_id','=','attendances.status')
        ->where('status.type',1)
        ->select('users.name','attendances.punch_in','attendances.punch_out','status.name AS attendance_status','attendances.latitude','attendances.longitude','attendances.created_at','attendances.updated_at');	
        return $attendances = $attendances->get();
 
    }
}
