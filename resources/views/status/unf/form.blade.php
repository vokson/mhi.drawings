<div align="center">


    {!! Form::open(array('action' => 'StatusController@search_UNF', 'method' => 'get', 'id' => 'search_form')) !!}

    <table class="table_input_button">
        <tr>
            <td class="td_button">
                {!! Form::submit('UNF PROJECT - DRAWING STATUS', ['class' => 'button_style' ]) !!}
            </td>
        </tr>
    </table>

    <table class="table_input_text">
        <tr>
            <td class="td_project"></td>
            <td class="td_name">
                {!! Form::text('name', null,
                    [
                       'id' => 'name',
                       'placeholder' => "Drawing",
                    ]
                ) !!}
            </td>
            <td class="td_revision">
                {!! Form::text('revision',  null,
                    [
                       'id' => 'revision',
                       'placeholder' => "Rev",
                    ]
                ) !!}

                {!! Form::checkbox('only_last_rev', null, true,
                    [
                        'id' => 'only_last_rev',
                        'title' => "Only last revisions"
                    ]
                ) !!}
            </td>
            <td class="td_part"></td>
            <td>
                {!! Form::text('title',  null,
                    [
                        'id' => 'title',
                        'placeholder' => "Title",
                    ]
                ) !!}
            </td>
            <td class="td_approval">
                {!! Form::text('approvedByDI',  null,
                    [
                       'id' => 'approvedByDI',
                       'placeholder' => "DI-A",
                    ]
                ) !!}
            </td>
            <td class="td_letter">
                {!! Form::text('letterFromDI',  null,
                    [
                       'id' => 'letterFromDI',
                       'placeholder' => "DI-L",
                    ]
                ) !!}
            </td>
            <td class="td_approval">
                {!! Form::text('approvedBySAC',  null,
                    [
                       'id' => 'approvedBySAC',
                       'placeholder' => "SAC-A",
                    ]
                ) !!}
            </td>
            <td class="td_letter">
                {!! Form::text('letterFromSAC',  null,
                    [
                       'id' => 'letterFromSAC',
                       'placeholder' => "SAC-L",
                    ]
                ) !!}
            </td>

        </tr>

    </table>
</div>


{!! Form::close() !!}