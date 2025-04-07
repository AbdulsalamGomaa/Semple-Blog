<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Post extends Model
{
    protected $fillable = [

        'title',
        'description',
        'user_id'
    ];

    public function user() {

        return $this->belongsTo(user::class);
    }
}
