<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSalary;
use App\Exports\ExportSalary;
use Session;
use Validator;

class SalaryController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\Salary::get();
        $salary         = \App\Models\Salary::select('salaries.*', 'users.name AS username', 'users.designation')
                                            ->leftJoin('users', 'users.id', '=', 'salaries.user_id')
                                            ->paginate(10);
        return view('admin.salary.index', compact(['salary', 'datacountlists']));
    }

    public function create(Request $request)
    {
        $employees = \App\Models\User::select('id','name')->where('role_id','3')->where('status','1')->get();
        return view('admin.salary.create', compact(['employees']));
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
                                            'user_id'    => 'required',
											'month'      => 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {	
			try 
			{
                $target            		= 'storage/uploads/salary/';
				$document     		    = $request->file('document');                
				if(!empty($document))
				{
					$headerImageName	= $document->getClientOriginalName();
					$ext1				= $document->getClientOriginalExtension();
					$temp1				= explode(".",$headerImageName);					
					$newHeaderLogo		= 'image'.round(microtime(true)).".".end($temp1);				
					$headerTarget		= 'storage/uploads/salary/'.$newHeaderLogo;
					$document->move($target,$newHeaderLogo);	
				} 
				else
				{
					$headerTarget				  = '';
				}
                $salary                 	  = new \App\Models\Salary();
                $salary->user_id              = $request['user_id'];
                $salary->month 		  	      = $request['month'];
                $salary->document	      		  = $headerTarget;
                $salary->save();
                Session::flash('message', 'Salary slip addedd Successfully  !');
                return redirect('admin/salary');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/salary/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }

    public function view(Request $request, $id='')
    {
        $salary = \App\Models\Salary::find($id);
        $salary->users = \App\Models\User::select('id','name')->find($salary->user_id);
        return view('admin.salary.view', compact(['salary']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Salary::whereIn('id',$ids)->delete();
        Session::flash('message', 'Salary Deleted Successfully! ');
        return redirect('admin/salary');
    }

    public function getImport(Request $request)
    {
        return view('admin.salary.import');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportSalary, $request->file('file')->store('files'));
        return redirect('admin/salary');
    }

    public function exportSalary(Request $request)
	{
        return Excel::download(new ExportSalary, 'salary.xlsx');
    }

}
