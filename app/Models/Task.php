<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'time', 'status', 'user_id'];

    protected $attributes = [
        'status' => 'PENDING',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
