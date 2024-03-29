<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $appends = ['name'];

    protected $fillable = [
        'teacher_id',
        'full_name',
        'gender',
        'date_of_birth',
        'mobile',
        'joining_date',
        'qualification',
        'experience',
        'username',
        'address',
        'city',
        'state',
        'zip_code',
        'subjects',
        'country',
    ];

    public static function subjects()
    {
        // Get all registered subject
        return Subject::all();
    }

    public function libraries()
    {
        return $this->hasMany(Library::class);
    }

    public function getNameAttribute()
    {
        return $this->full_name;
    }
}
