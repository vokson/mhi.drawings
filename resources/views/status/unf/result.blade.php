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
            <th class="td_title">Title</th>
            <th class="td_approval">DI-A</th>
            <th class="td_letter">DI-L</th>
            <th class="td_approval">SAC-A</th>
            <th class="td_letter">SAC-L</th>
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
                <td class="td_title">{{ $doc->title }}</td>

                <td class="td_approval">
                    @if ($doc->approvedByDI)
                        YES
                    @else
                        NO
                    @endif
                </td>

                <td class="td_letter">{{ $doc->letterFromDI }}</td>

                <td class="td_approval">
                    @if ($doc->approvedBySAC)
                        YES
                    @else
                        NO
                    @endif
                </td>

                <td class="td_letter">{{ $doc->letterFromSAC }}</td>

            </tr>
        @endforeach
    </table>

@endif
