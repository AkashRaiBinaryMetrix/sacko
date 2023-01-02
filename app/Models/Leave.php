<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    // public function ScopeviewMyLeaveByUserId($query, $id = null)
    // {
    //     return $query->where('user_id',$id)->orderBy('id','DESC')->get();
    // }
    
    public function ScopeGetAllLeaveByUserId($query, $id)
    {
        return $query->where('user_id',$id)->orderBy('updated_at','DESC')->get();
    } 
}
