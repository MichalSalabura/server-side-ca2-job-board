<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jobseeker extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
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
