<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    final const SERVICE_GOOGLE = 'google';
    final const SERVICE_GITHUB = 'github';

    protected $fillable = [
        'provider',
        'provider_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
