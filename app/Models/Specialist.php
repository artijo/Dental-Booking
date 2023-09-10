<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Doctor;

class Specialist extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'specialist_id';
    protected $keyType = 'string';
    public function doctors() {
        return $this->belongsToMany(Doctor::class, 'doctor_id');
    }
}
