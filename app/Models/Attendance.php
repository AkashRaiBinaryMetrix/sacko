<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    public function ScopeviewAttendanceByUserId($query, $id = null)
    {
        return $query->where('user_id',$id)->orderBy('id','DESC')->get();
    }
}
