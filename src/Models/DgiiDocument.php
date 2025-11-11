<?php

namespace DazzaDev\LaravelDgiiSv\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DgiiDocument extends Model
{
    use SoftDeletes;

    protected $casts = [
        'success' => 'boolean',
        'messages' => 'array',
    ];

    protected $fillable = [
        'document_type',
        'control_number',
        'generation_code',
        'receipt_seal',
        'status',
        'messages',
        'signed_json',
        'documentable_id',
        'documentable_type',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
