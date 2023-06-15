<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded=[];

    // RELATIONS
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Vote::class);
    }
}
