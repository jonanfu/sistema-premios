<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sale;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        'lastname',
        'cedula',
        'address',
        'phone',
        'email',
        'points',
        'referred_by',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // public function referrals()
    // {
    //     return $this->hasMany(Client::class, 'referred_by');
    // }

    public function add_points($points)
    {
        $this->increment('points', $points);
    }

    public function subtrack_points($points)
    {
        $this->decrement('points', $points);
    }

     public function getFullNameAttribute()
    {
        $fullName = $this->lastname . ' ' . $this->names;
        return mb_strtoupper($fullName);
    }

     public function referredBy()
    {
        return $this->belongsTo(Client::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(Client::class, 'referred_by');
    }


}
