<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','category_id','user_id','status','day_count','end_date','provider_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function provider(){
        return $this->belongsTo(User::class)->where('user_type' , 'merchant')->withDefault();
    }
}
