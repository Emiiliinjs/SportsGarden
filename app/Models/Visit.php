<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'user_agent',
        'user_id',
    ];

    /**
     * Apmeklējums pieder konkrētam lietotājam (ja ir pieslēdzies).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
