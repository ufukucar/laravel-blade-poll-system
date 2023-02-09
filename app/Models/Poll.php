<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'started_at', 'finished_at'];

    protected $withCount = ['questions'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function finishedAt(): Attribute
    {
        return new Attribute(
            //get: fn ($value) => Carbon::parse($value)->format('Y.m.d, H:i:s'),
        );
    }

    public function startedAt(): Attribute
    {
        return new Attribute(
            //get: fn ($value) => Carbon::parse($value)->format('Y.m.d, H:i:s'),
        );
    }

}
