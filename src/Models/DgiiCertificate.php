<?php

namespace DazzaDev\LaravelDgiiSv\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DgiiCertificate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'path',
        'password',
        'expiration_date',
        'certificable_id',
        'certificable_type',
    ];

    public function certificable()
    {
        return $this->morphTo();
    }
}
