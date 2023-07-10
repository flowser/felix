<?php

namespace App\Models\Subscription;

use App\Models\Subscription\Website;
use App\Models\Subscription\Subscriber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
         'title',
         'description',
         'website_id',
         'sent',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
