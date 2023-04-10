<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    protected $keyType = 'uuid';

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'constituency_id', 'id');
    }
}
