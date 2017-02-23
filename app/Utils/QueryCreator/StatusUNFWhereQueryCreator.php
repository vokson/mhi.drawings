<?php

namespace App\Utils\QueryCreator;

class StatusUNFWhereQueryCreator extends WhereQueryCreator
{
    protected $columns = [
        ['project', 'like'],
        ['name', 'like'],
        ['revision', '='],
        ['part', '='],
        ['title', 'like'],
        ['transmittal', 'like'],
        ['repliedByDI', '='],
        ['repliedBySAC', '='],
        ['approvedByDI', '='],
        ['approvedBySAC', '='],
        ['letterFromDI', 'like'],
        ['letterFromSAC', 'like'],
    ];

    protected $nameOfTable = 'unf_status';

}