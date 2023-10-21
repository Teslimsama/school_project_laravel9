<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function scopeUserIsATeacher()
    // {

    //     $role = DB::table('role_user')->where("user_id", $this->user_id)->first();

    //     if ( $role->role_id === 3 ) {

    //         // dd('Hie here');
    //         $user = User::where('id', $this->user_id)->first();
    //         if ( $user !== null ) {
    //             return $user;
    //         }
    //     }


    //     return null;
    // }

}
