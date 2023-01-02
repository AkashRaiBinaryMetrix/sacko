<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    use HasFactory;
    public function ScopeGetAllResignationByUserId($query, $id)
    {
        return $query->where('user_id',$id)->orderBy('updated_at', 'DESC')->get();
    }
}
