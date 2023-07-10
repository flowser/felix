<?php

namespace App\Models\Subscription;

use App\Models\Subscription\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'active',
        'website_id',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
}
