<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    public function gradebook() {
        return $this->belongsTo(Gradebook::class);
    }    

    public function user() {
        return $this->belongsTo(User::class);
    } 
}
