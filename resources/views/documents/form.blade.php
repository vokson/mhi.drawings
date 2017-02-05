<div align="center">


    {!! Form::open(array('action' => 'DocumentController@search', 'method' => 'get', 'id' => 'search_form')) !!}
{{--    {!! Form::open() !!}--}}

    <table class="table_input_button">
        <tr>
            <td class="td_button_download_all_pdf">
                <input type="button" class="button_style"
                       id="button_download_all_pdf" value="DOWNLOAD ALL FOUND PDF"
                       title="Download all founded documents in PDF format. In case there are many documents the action may take several minutes."/>
            </td>
            <td class="td_button">
                {!! Form::submit('SEARCH', ['class' => 'button_style' ]) !!}
            </td>
            <td class="td_button_download_all_dwg">
                <input type="button" class="button_style"
                       id="button_download_all_dwg" value="DOWNLOAD ALL FOUND DWG"
                       title="Download all founded documents in DWG format. In case there are many documents the action may take several minutes."/>
            </td>
        </tr>
    </table>

    <table class="table_input_text">
        <tr>
            <td class="td_icon">
                <img src="/img/clear.jpg" width="32px" height="32px" id="button_clear" title="Clear all fields"/>
            </td>
            <td class="td_project">
                {!! Form::text('project', null,
                    [
                       'id' => 'project',
                       'placeholder' => "Project",
                       'title' => "Number of project. RPA is 6453",
                    ]
                ) !!}
            </td>
            <td class="td_name">
                {!! Form::text('name', null,
                    [
                       'id' => 'name',
                       'placeholder' => "Drawing",
                       'title' => "Number of drawing or part of number. For example, 'C320-02-251100'."
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
            <td class="td_part">
                {!! Form::text('part',  null,
                    [
                       'id' => 'part',
                       'placeholder' => "Part",
                       'title' => "Part of document. Most of documents have only part 1."
                    ]
                ) !!}
            </td>
            <td class="td_status">
                {!! Form::text('status',  null,
                    [
                       'id' => 'status',
                       'placeholder' => "St",
                       'title' => "FR - for review; FI - for information; FC - for construction; FA - for approval"
                    ]
                ) !!}
            </td>
            <td>
                {!! Form::text('title',  null,
                    [
                        'id' => 'title',
                        'placeholder' => "Drawing's title",
                        'title' => "For example, 'mdea pump house'."
                    ]
                ) !!}
            </td>
            <td class="td_date">
                {!! Form::date('date_beg',  null,
                    [
                        'id' => 'date_beg',
                        'placeholder' => "Start Date",
                        'title' => "Document has been received not early than this date."
                    ]
                ) !!}
                {!! Form::date('date_end',  null,
                    [
                        'id' => 'date_end',
                        'placeholder' => "End Date",
                        'title' => "Document has been received not later than this date."
                    ]
                ) !!}
            </td>
            <td class="td_transmittal">
                {!! Form::text('transmittal',  null,
                    [
                        'id' => 'transmittal',
                        'placeholder' => "Transmittal",
                        'title' => "Transmittal's name or part of name. For example, 'TAF-SJZ-AMM-0204-T'."
                    ]
                ) !!}
            </td>

        </tr>

    </table>
</div>


{!! Form::close() !!}