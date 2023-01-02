<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;
    public function ScopeGetAllIncentiveByUserId($query, $id)
    {
        return $query->where('user_id',$id)->orderBy('updated_at', 'DESC')->get();
    }
}
