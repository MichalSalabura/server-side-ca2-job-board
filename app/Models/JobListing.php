<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'title',
        'description',
        'location',
        'salary',
        'type',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
