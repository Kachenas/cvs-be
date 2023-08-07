<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Group;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    use HasFactory;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id','user_id','group_id','voucher_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getUserWithVoucher($data)
    {
        try {
            $data =  $data = DB::table('users as u')
                    ->join('vouchers as v','u.id', '=', 'v.user_id')
                    ->select('u.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as full_name'),'v.voucher_code','u.user_role','u.group_id')
                    ->whereIn('v.user_id',$data)
                    ->get();
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        return $data;
    }

}
