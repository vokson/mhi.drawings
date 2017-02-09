<div align="center">


    {!! Form::open(array('action' => 'StatusController@search_UNF', 'method' => 'get', 'id' => 'search_form')) !!}

    <table class="table_input_button">
        <tr>
            <td class="td_button">
                {!! Form::submit('SEARCH', ['class' => 'button_style' ]) !!}
            </td>
        </tr>
    </table>

    <table class="table_input_text">
        <tr>
            <td class="td_name">
                {!! Form::text('name', null,
                    [
                       'id' => 'name',
                       'placeholder' => "Drawing",
                       'title' => "Number of drawing or part of number. For example, 'C320-01010'."
                    ]
                ) !!}
            </td>
            <td class="td_revision">
                {!! Form::text('revision',  null,
                    [
                       'id' => 'revision',
                       'placeholder' => "Rev",
                       'title' => "Number of revision. For example, 0,1,2,3..."
                    ]
                ) !!}

                {!! Form::checkbox('only_last_rev', null, true,
                    [
                        'id' => 'only_last_rev',
                        'title' => "Only last revisions"
                    ]
                ) !!}
            </td>

        </tr>

    </table>
</div>


{!! Form::close() !!}