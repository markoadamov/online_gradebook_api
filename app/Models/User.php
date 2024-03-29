<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'image_url',
        'accepted_terms'
    ];

    public static function scopeSearchByName($query, $filterTerm)
    {
        if (!$filterTerm) {
            return $query;
        }
        return $query->whereRaw("LOWER(first_name) = ?", [strtolower($filterTerm)]);
    }
    
    public static function scopeSearchNotClassTeachers($query, $only_free)
    {
        if ($only_free) {
            return $query->whereNull('gradebook_id');
        }
        return $query;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function gradebook() {
        return $this->hasOne(Gradebook::class);
        //return $this->belongsTo(Gradebook::class);
    } 
}
