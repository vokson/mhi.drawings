Count of documents {{ count($docs) }} </br>
@if(count($docs) == 0)
    Please, manage SEARCH conditions !!!
@else

    <table id="docTable" class="tablesorter">
        <thead>
        <tr>
            <th class="td_project">Project</th>
            <th class="td_name">Drawing</th>
            <th class="td_revision">Rev</th>
            <th class="td_part">Part</th>
            <th class="td_DI_approval">DI approval</th>
            <th class="td_DI_letter">DI letter</th>
            <th class="td_SAC_approval">SAC approval</th>
            <th class="td_SAC_letter">SAC letter</th>
        </tr>
        </thead>

        @foreach ($docs as $doc)
            <tr id="{{ $doc->id }}" class="document">

                <td class="td_project">{{ $doc->project }}</td>
                <td class="td_name">
                    @if ($doc->isPdfExist)
                        <a href="{{ action('StatusController@getSinglePdf', ['id' => $doc->id])  }}">
                            @endif

                            {{ $doc->name }}

                            @if ($doc->isPdfExist)
                        </a>
                    @endif
                </td>

                <td class="td_revision">{{ $doc->revision }}</td>
                <td class="td_part">{{ $doc->part }}</td>
                <td class="td_DI_approval">{{ $doc->approvedByDI }}</td>
                <td class="td_DI_letter">{{ $doc->letterFromDI }}</td>
                <td class="td_SAC_approval">{{ $doc->approvedBySAC }}</td>
                <td class="td_SAC_letter">{{ $doc->letterFromSAC }}</td>

            </tr>
        @endforeach
    </table>

@endif
