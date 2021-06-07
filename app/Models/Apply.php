<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_job',
        'status',
        'description',
        'file',
    ];



    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
