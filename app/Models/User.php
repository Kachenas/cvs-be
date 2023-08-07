<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Voucher;
use App\Models\Group;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id','first_name', 'middle_name','last_name','email','user_role','group_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //regular user has many vouchers
    public function showVouchers()
    {
        //return $this->hasMany(Voucher::class,'user_id');
        try {
            $data = DB::table('users as u')
                    ->join('vouchers as v','u.id', '=', 'v.user_id')
                    ->select('v.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as full_name'),'v.voucher_code','u.user_role','u.group_id')
                    ->where('v.user_id','=', Auth::user()->id)
                    ->get();
        } catch (\Exception $e) {
            $data = $e;
        }

        return $data;
    }

    public function viewUsers()
    {
        try {
            $data = DB::table('users as u')
                    ->join('vouchers as v','u.id', '=', 'v.user_id')
                    ->select('u.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as full_name'),'v.voucher_code','u.user_role','u.group_id')
                    ->get();
        } catch (\Exception $e) {
            $data = $e;
        }

        return $data;
    }

    public function viewGroupAdmin()
    {

        try {
            $groups = DB::table('users as u')
                    ->join('group_admin as g','u.id', '=', 'g.group_admin_id')
                    ->select('u.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as assign_admin'),'g.id as group_id','g.group_name','u.user_role')
                    ->where('u.user_role',2)
                    ->get(); 

            $data = $groups;

        } catch (\Exception $e) {
            $data = $e->getMessage();
        }

        return $data;
    }

    public function viewAdmins()
    {
        try {

            $data = DB::table('users as u')
            ->select('u.id',DB::raw('CONCAT(u.first_name," ",u.last_name) as assign_admin'),'u.user_role')
            ->where('u.user_role',2)
            ->get(); 
            
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        return $data;
    }


    public function groups()
    {
        return $this->hasMany(Group::class,'group_admin_id');
    }

}
