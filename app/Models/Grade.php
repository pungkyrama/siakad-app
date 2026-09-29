<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['krs_detail_id', 'numeric_score', 'letter_grade'])]
class Grade extends Model
{
    use HasFactory;

    public function krsDetail(): BelongsTo
    {
        return $this->belongsTo(KrsDetail::class);
    }
}
