<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=[
        'cname', 'cnumber','caddress','user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
