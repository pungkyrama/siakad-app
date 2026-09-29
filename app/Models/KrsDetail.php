<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['krs_id', 'class_schedule_id'])]
class KrsDetail extends Model
{
    use HasFactory;

    public function krs(): BelongsTo
    {
        return $this->belongsTo(Krs::class);
    }

    public function classSchedule(): BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    public function grade(): HasOne
    {
        return $this->hasOne(Grade::class);
    }
}
