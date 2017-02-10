<?php

namespace App\Utils\QueryCreator;

use Illuminate\Http\Request;


abstract class WhereQueryCreator
{

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

                    $query[] = [$this->nameOfTable . '.' . $nameInDatabase, $operator, $value];
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