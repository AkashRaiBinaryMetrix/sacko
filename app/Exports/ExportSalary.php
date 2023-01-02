<?php

namespace App\Exports;

use App\Models\Salary;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportSalary implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Employee Id',
            'Employee Name',
            'Month',
            'Document',
            'Status',
            'Created_at',
            'Updated_at' 
        ];
    }

    public function collection()
    {
        $salaries  = DB::table('salaries')
        ->leftjoin('users','users.id','=','salaries.user_id')
        ->leftjoin('status','status.status_id','=','salaries.status')
        ->where('status.type',1)
        ->select('users.employee_id','users.name AS user_name','salaries.month','salaries.document','status.name AS salary_status',
        'salaries.created_at','salaries.updated_at');	
        return $salaries = $salaries->get();
 
    }
}
