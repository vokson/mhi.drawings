Count of documents {{ count($docs) }} </br>
@if(count($docs) == 0)
    Please, manage SEARCH conditions !!!
@else

    <table id="docTable" class="tablesorter">
        <thead>
        <tr>
            <th class="td_icon"/>
            <th class="td_project">Project</th>
            <th class="td_name">Drawing</th>
            <th class="td_revision">Rev</th>
            <th class="td_part">Part</th>
            <th class="td_status">St</th>
            <th class="td_title">Title</th>
            <th class="td_date">Date</th>
            <th class="td_transmittal">Transmittal</th>
        </tr>
        </thead>

        @foreach ($docs as $doc)
            <tr id="{{ $doc->id }}" class="document">

                <td class="td_icon">
                    @include('documents.partials.icon')
                </td>

                <td class="td_project">{{ $doc->project }}</td>

                <td class="td_name">
                    @include('documents.partials.name')
                </td>

                <td class="td_revision">{{ $doc->revision }}</td>
                <td class="td_part">{{ $doc->part }}</td>
                <td class="td_status">{{ $doc->status }}</td>
                <td class="td_title">{{ $doc->title }}</td>
                <td class="td_date">
                    <?php
                        echo Carbon\Carbon::parse($doc->issued_at)->format('d-m-Y');
                    ?>
                </td>
                <td class="td_transmittal">{{ $doc->transmittal }}</td>
            </tr>
        @endforeach
    </table>

@endif
