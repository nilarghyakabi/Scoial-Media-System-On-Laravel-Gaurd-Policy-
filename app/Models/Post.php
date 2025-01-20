<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;



class Post extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'caption',
        'user_id',
        'image',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
