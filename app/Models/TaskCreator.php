<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCreator extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'creator',
        'email',
    ];
}
