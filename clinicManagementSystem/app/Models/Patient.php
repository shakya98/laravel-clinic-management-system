<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'contact_no',
        'photo',
        'nic',
        'notes',
    ];

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
