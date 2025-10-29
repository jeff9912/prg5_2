<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Artist extends Model
{


    use HasFactory;

    protected $fillable = [
        'artist_name',
        'genre',
        'description',
        'user_id',
        'hidden',
    ];

// Artist belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
