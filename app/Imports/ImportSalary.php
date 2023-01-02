<?php

namespace App\Imports;
use App\Models\Salary;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class ImportSalary implements ToCollection, WithStartRow
{
    use Importable;
    /*function __construct($override_data)
    {
        $this->override_data = $override_data;
    }
	*/

    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)    
    {
        
        foreach($rows as $row)
        {
            $user            = \App\Models\User::where('employee_id', $row[0])->first();
            if(is_object($user) && !empty($user))
            {
                $salary             = new Salary();
                $salary->user_id    = $user->id;
                $salary->month      = $row[1];
                $salary->document   = $row[2];
                $salary->save();
            }
            //return $salary;
            
        }
       
       
    } 


   
}
