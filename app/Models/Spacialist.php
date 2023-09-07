<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Doctor;

class Spacialist extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }
}
