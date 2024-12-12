<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable 
{
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email', 'phone' ,'role' , 'user_type' , 'commercial_register' , 'image',
        'password', 'discription','website_link'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'image'
    ];

    protected $appends = [
        'image_url' , 
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 
    public function categories(){

        // return $this->belongsToMany(Category::class);
        return $this->belongsToMany(Category::class, 'category_user', 'user_id', 'category_id');


    }

    public function products(){

        return $this->belongsToMany(Product::class);

    }

    public function subscriptions(){
        return $this->hasOne(Subscription::class);
    }

    public function getImageUrlAttribute()
    {
        // column image in database
        if (!$this->image) {
            return "https://aui.atlassian.com/aui/8.8/docs/images/avatar-person.svg";
        }

        // if $this->image start with http:// or https://
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
