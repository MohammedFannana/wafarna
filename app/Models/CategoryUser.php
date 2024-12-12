<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'category_id','user_id'
    ];
}
