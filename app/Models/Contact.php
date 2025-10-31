<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;

     use SoftDeletes;

    protected $fillable = [
        'name','email','number','bio','user_id','is_active','profile_image'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // helper to return storage URL for image
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image ? asset('storage/'.$this->profile_image) : asset('images/avatar-placeholder.png');
    }


}
