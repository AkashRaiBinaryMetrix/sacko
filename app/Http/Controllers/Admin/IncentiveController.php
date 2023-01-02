<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportIncentive;
use App\Exports\ExportIncentive;
use Validator;
use Session;

class IncentiveController extends Controller
{
    public function index()
    {
        $datacountlists = \App\Models\Incentive::get();
        $incentive      = \App\Models\Incentive::select('incentives.*', 'users.name AS user_name', 'products.name AS product_name')
						->leftJoin('users', 'users.id', '=', 'incentives.user_id')
						->leftJoin('products', 'products.id', '=', 'incentives.product_id')
						->paginate(10);

        return view('admin.incentive.index', compact(['incentive', 'datacountlists']));
    }

    public function create(Request $request)
    {
        $employees = \App\Models\User::select(\DB::raw("id,name AS name"))
                    ->where('role_id','3')
                     ->where('status', 1)
                     ->get();
		$products = \App\Models\Product::all();
        return view('admin.incentive.create', compact(['employees','products']));
    }

	public function store(Request $request)
    {	
        $v = Validator::make($request->all(), [
											'user_id'		=> 'required',
											'product_id' 	=> 'required',
											]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors());
        }
        else
        {	
			try 
			{
                $incentive                 		= new \App\Models\Incentive();
				$incentive->user_id 		  	= $request['user_id'];
				$incentive->product_id 		  	= $request['product_id'];
				$incentive->gift 				= $request['gift'];
				$incentive->quantity 			= $request['quantity'];
				$incentive->save();
				Session::flash('message', 'Incentive Added Successfully  !');
				return redirect('admin/incentive');
			} 
			catch (\Exception $e) 
			{
				$status 	= false;
				$message 	= $e->getMessage();
				return redirect('admin/incentive/create')->withInput($request->input())->withErrors(array('message' => $message));
			}
        }   
    }
    
    public function view(Request $request, $id='')
    {
        $incentive          = \App\Models\Incentive::select('users.employee_id','users.name AS username','users.mobile','cd.name AS tl_name','cd.mobile AS tl_number',
        'users.designation','users.trade','users.doj','users.lwd','states.name as state_name','cities.name as city_name',
        'users.address','incentives.product_id','products.name AS product_name','incentives.quantity','incentives.gift',
        'incentives.created_at','incentives.updated_at')
        ->leftjoin('users','users.id','=','incentives.user_id')
        ->leftjoin('users AS cd','cd.id','=','users.assign_tl')
        ->leftjoin('products','products.id','=','incentives.product_id')
        ->leftjoin('states','states.id','=','users.state_id')
        ->leftjoin('cities','cities.id','=','users.city_id')
        ->leftjoin('status','status.status_id','=','users.status')
        ->where('status.type',1)
        ->find($id);
        
        return view('admin.incentive.view', compact(['incentive']));
    }

    public function delete(Request $request, $id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Incentive::whereIn('id',$ids)->delete();
        Session::flash('message', 'Incentive Deleted Successfully! ');
        return redirect('admin/incentive');
    }

    public function getImport(Request $request)
    {
        return view('admin.incentive.import');
    }

    public function import(Request $request)
    {
        Excel::import(new ImportIncentive, $request->file('file')->store('files'));
        return redirect('admin/incentive');
    }

    public function exportIncentive(Request $request)
	{
        return Excel::download(new ExportIncentive, 'incentive.xlsx');
    }
    
    

}
