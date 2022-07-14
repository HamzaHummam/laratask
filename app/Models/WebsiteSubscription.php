<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
         'website_id', 'subscriber_email'
    ];
}
