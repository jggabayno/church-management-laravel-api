<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['photo','first_name', 'middle_name', 'last_name',
    'mobile_number','birth_date', 'place_of_birth', 'age', 'gender',
    'citizenship', 'occupation', 'fathers_maiden_name', 'mothers_maiden_name',
    'email',  'password', 'user_type_id','position_id','status','added_by'];

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
    ];

    public function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $userWithDateFilter = $hasDateToFilter
            ? User::whereBetween('created_at', [$request->start_date, $request->end_date])->whereNull('deleted_at')
            : User::whereNull('deleted_at');
        
            return $userWithDateFilter;
    }

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class)->select([
            'id',
            'user_id',
            'house_no',
            'street',
            'barangay',
            'municipality'
        ]);
    }

    public function weddings()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }
}