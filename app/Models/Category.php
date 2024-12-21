<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','discription','image'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function users(){

        return $this->belongsToMany(User::class);

    }


    public function getImageCategoryUrlAttribute()
    {
        // column image in database
        if (!$this->image) {
            return asset('image/logo.png');
        }

        // if $this->image start with http:// or https://
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
