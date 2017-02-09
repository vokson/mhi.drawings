<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusUNF extends Model
{
    public $timestamps = true;

    protected $table = 'unf_status';

    protected $fillable = [
        'project',
        'name',
        'revision',
        'part',
        'status',
        'path',
        'isPdfExist',
        'approvedByDI',
        'letterFromDI',
        'approvedBySAC',
        'letterFromSAC'
    ];

    protected $dates = [
        'issued_at',
        'created_at',
        'updated_at'
    ];
}
