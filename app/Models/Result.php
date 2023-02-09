<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'poll_id', 'question_id', 'option_id'];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
