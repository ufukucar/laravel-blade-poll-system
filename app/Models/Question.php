<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id', 'question'];

    protected $with = ['options'];
    protected $withCount = ['options'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }



    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

}
