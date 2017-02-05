<?php

namespace App\Utils;

use Illuminate\Http\Request;


class WhereQueryCreator
{
    private $columns = [
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

    public function make(Request $request)
    {
        $query = [];

        foreach ($this->columns as $column) {
            list ($nameInForm, $nameInDatabase, $operator) = $this->splitColumnByNamesAndOperator($column);

            $input = $request->input($nameInForm);

            if ($nameInForm == 'title') {
                $values = explode(' ', $input);
            } else {
                $values = [$input];
            }

            foreach ($values as $value) {
                if ($value != "") {

                    if ($operator == 'like') {
                        $value = '%' . $value . '%';
                    }

                    $query[] = ['documents.' . $nameInDatabase, $operator, $value];
                }
            }
        }

        return $query;
    }

    private function splitColumnByNamesAndOperator($column)
    {
        $nameInDatabase = $nameInForm = $column[0];
        $operator = $column[1];

        if (isset($column[2])) {
            $nameInDatabase = $column[2];
        }

        return [$nameInForm, $nameInDatabase, $operator];
    }

}