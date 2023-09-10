<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'support_id';
    protected $keyType = 'string';
}
