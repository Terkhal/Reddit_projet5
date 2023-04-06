<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'is_archived',
        'is_sub_com',
        'reply_to',


    ];
}
