<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','category_id','user_id','description','image','price','place','phone'
    ];

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    protected $appends = [
        'cover_image_url' , 
    ];

    protected $hidden = [
        'image',
    ];

    public function getCoverImageUrlAttribute(){
        
         // column image in database
        if (!$this->image) {
            return 'https://placehold.co/800x300';
        }

        // if $this->image start with http:// or https://
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);

    }


}
