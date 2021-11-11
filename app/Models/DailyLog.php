<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyLog extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'daily_logs';

    protected $dates = ['deleted_at'];

    //protected $softDelete = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'log',
        'day',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'day' => 'datetime',
    ];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function getDayAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function scopefromToday($query)
    {
        return $query->where('day', Carbon::now());
    }
}