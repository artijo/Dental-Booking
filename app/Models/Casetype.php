<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CaseMD;

class Casetype extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'casetype_id';

    public function cases() {
        return $this->hasMany(CaseMD::class, 'caseid');
    }
}
