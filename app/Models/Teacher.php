<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Appends custom attributes to response
     */
    protected $appends = [
        'full_name'
    ];

    /**
     * Get the relation between user and teacher
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }

    /**
     * Get The fullname of the teacher
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /*
     * Get the students of the teacher
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', 'teacher_id', 'id');
    }
}
