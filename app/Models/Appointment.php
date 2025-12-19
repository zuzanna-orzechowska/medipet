<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
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
