<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'species', 'breed', 'birth_date'];

    public function owner(): BelongsTo
        {
            return $this->belongsTo(User::class, 'user_id');
        }

    public function appointments(): HasMany
        {
            return $this->hasMany(Appointment::class);
        }
}
