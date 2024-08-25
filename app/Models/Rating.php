<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'review',
    ];

    // العلاقة مع المستخدم: كل تقييم ينتمي إلى مستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الفيلم: كل تقييم ينتمي إلى فيلم
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
