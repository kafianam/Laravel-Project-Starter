<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaProcessingForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'name',
        'passport_number',
        'nationality',
        'travel_from',
        'travel_type',
        'expected_travel_date',
        'primary_contact',
        'emergency_contact',
        'email',
        'passport_copy',
        'ticket_copy',
        'hotel_booking',
        'other_doc',
        'advance_purchase',
        'application_status',
        'payment_status',
        'payment_method',
        'payment_date',
    ];

    protected $casts = [
        'advance_purchase' => 'array',
        'expected_travel_date' => 'date',
        'payment_date' => 'date',
        'application_submit_date' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($form) {
            if (auth()->check()) {
                $form->user_id = auth()->id();
            }
        });
    }
    

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
