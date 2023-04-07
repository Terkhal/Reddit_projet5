<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'is_archived',
        'is_sub_com',
        'reply_to',
        'post_id',
        'category_id'

    ];

    public function category(): HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
}
