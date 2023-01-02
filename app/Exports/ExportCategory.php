<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportCategory implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Category Name',
            'Meta Title',
            'Meta Description',
            'Status',
            'Created_at',
            'Updated_at' 
        ];
    }

    public function collection()
    {
        $categories  = DB::table('categories')
        ->leftjoin('status','status.status_id','=','categories.status')
        ->where('status.type',1)
		->whereNull('parent_id')
        ->select('categories.name AS category_name','categories.meta_title','categories.meta_description','status.name AS category_status',
        'categories.created_at','categories.updated_at');
         return $categories = $categories->get();
    }
}
