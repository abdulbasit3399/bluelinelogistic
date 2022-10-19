<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'staffs';
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\StaffFactory::new();
    }
    public function branch(){
        return $this->hasOne('Modules\Cargo\Entities\Branch', 'id', 'branch_id');
    }
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function getStaff($query)
    {
        if(auth()->user()->role == 3){
            $branch = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
            $query = $query->where('is_archived', 0)->where('branch_id', $branch);
        }elseif(auth()->user()->can('manage-staffs') && auth()->user()->role == 0){
            $branch = Staff::where('user_id',auth()->user()->id)->pluck('branch_id')->first();
            $query = $query->where('is_archived', 0)->where('branch_id', $branch);
        }
        return $query;
    }
}
