<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CaseMD;
use App\Models\Specialist;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'doctor_id';
    protected $keyType = 'string';

    public function cases() {
        return $this->hasMany(CaseMD::class, 'caseid');
    }
    public function specialists() {
        return $this->belongsToMany(Specialist::class, 'specialist_id');
    }
}
