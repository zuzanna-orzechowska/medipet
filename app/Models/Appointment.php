<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'doctor_id', 'pet_id', 'service_id', 'appointment_date', 'status', 'notes'];

    public function client(): BelongsTo
        {
            return $this->belongsTo(User::class, 'client_id');
        }

    public function doctor(): BelongsTo
        {
            return $this->belongsTo(User::class, 'doctor_id');
        }

    public function pet(): BelongsTo
        {
            return $this->belongsTo(Pet::class);
        }

    public function service(): BelongsTo
        {
            return $this->belongsTo(Service::class);
        }
}
