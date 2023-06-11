<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['total_bill', 'patient_id', 'record_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
