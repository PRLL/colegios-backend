<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'submitted_by', 'complained_of'
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
     * Get the relation between user and complaint
     */
    public function submittedBy()
    {
        return $this->belongsTo("App\Models\User", 'submitted_by', 'id');
    }

    /**
     * Get the relation between user and complaint
     */
    public function complainedOf()
    {
        return $this->belongsTo("App\Models\User", 'complained_of', 'id');
    }
}
