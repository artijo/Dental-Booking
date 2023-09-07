<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Doctor;
use App\Models\Booking;
use App\Models\Patient;

class CaseMD extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    public function casetype() {
        return $this->belongsTo(Casetype::class);
    }
}
