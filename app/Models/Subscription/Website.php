<?php

namespace App\Models\Subscription;

use App\Models\Subscription\Post;
use App\Models\Subscription\Subscriber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Website extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }

}
