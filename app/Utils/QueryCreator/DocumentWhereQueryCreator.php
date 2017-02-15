<?php

namespace App\Utils\QueryCreator;

class DocumentWhereQueryCreator extends WhereQueryCreator
{
    protected $columns = [
        ['project', 'like'],
        ['name', 'like'],
        ['revision', '='],
        ['part', '='],
        ['status', 'like'],
        ['title', 'like'],
        ['date_beg', '>=', 'issued_at'],
        ['date_end', '<=', 'issued_at'],
        ['transmittal', 'like'],
    ];

    protected $nameOfTable = 'documents';

}