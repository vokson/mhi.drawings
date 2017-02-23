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
        'title',
        'transmittal',
        'path',
        'isPdfExist',
        'repliedByDI',
        'approvedByDI',
        'letterFromDI',
        'repliedBySAC',
        'approvedBySAC',
        'letterFromSAC'
    ];

    protected $dates = [
        'issued_at',
        'created_at',
        'updated_at'
    ];
}
