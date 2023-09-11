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

    protected $primaryKey = 'caseid';
    protected $keyType = 'string';
    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function bookings() {
        return $this->hasMany(Booking::class, 'caseid');
    }
    public function patient() {
        return $this->belongsTo(Patient::class, 'idcard');
    }
    public function casetype() {
        return $this->belongsTo(Casetype::class, 'casetype_id');
    }
}
