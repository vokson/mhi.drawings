<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'project',
        'name',
        'revision',
        'part',
        'status',
        'title',
        'transmittal',
        'path',
        'isPdfExist',
        'isDwgExist',
        'issued_at'
    ];

    protected $dates = [
        'issued_at',
        'created_at',
        'updated_at'
    ];
}
