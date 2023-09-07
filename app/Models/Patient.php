<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CaseMD;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function cases() {
        return $this->hasMany(CaseMD::class);
    }
}
