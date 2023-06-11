<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['prescription', 'record_id'];

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
