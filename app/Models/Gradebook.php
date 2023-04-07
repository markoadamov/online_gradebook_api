<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public static function scopeSearchByTerm($query, $filterTerm)
    {
        if (!$filterTerm) {
            return $query;
        }
        return $query->where('name', 'like', "%$filterTerm%");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        $firstName = $this->user->first_name;
        $lastName = $this->user->last_name;

        return $firstName . ' ' . $lastName;
    }
}
