<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * Masveida aizpildāmie lauki (mass assignable)
     */
    protected $fillable = [
        'user_id',
        'rumor_id',
        'content',
    ];

    /**
     * Automātiski ielādētās attiecības (mazāk SQL pieprasījumu)
     */
    protected $with = ['user'];

    /**
     * Saite uz Rumor, pie kura pieder komentārs
     */
    public function rumor()
    {
        return $this->belongsTo(Rumor::class);
    }

    /**
     * Saite uz lietotāju, kas publicēja komentāru
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lokālais scope – sakārtot komentārus no jaunākā uz vecāko
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
