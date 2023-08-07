<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Voucher;

class Group extends Model
{
    protected $table = 'group_admin';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    use HasFactory;

     /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id','group_name', 'group_admin_id','email'];

    // public function groupAdmin()
    // {
    //     return $this->belongsTo(User::class, 'group_admin_id');
    // }

    //group has many users
    public function users()
    {
        return $this->hasMany(User::class, 'group_id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'group_id');
    }

    public function viewGroups() 
    {
        try {
            
            $data = DB::table('group_admin as g')
            ->leftJoin('users as u','g.group_admin_id', '=', 'u.id')
            ->select('g.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as full_name'),'g.group_name','g.email')
            ->get();

        } catch (\Exception $e) {
            $data = $e;
        }
        return $data;
    }

}
