<?php

namespace App\Http\Controllers;

use App\Utils\DocumentNameCreator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Utils\PdfCommentDocumentNameCreator;

use App\Utils\WhereQueryCreator;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{

    public function index()
    {
        return view('status.unf.index');
    }

    public function search_UNF(Request $request)
    {
        {
//        dd($request);

            $queryCreator = new WhereQueryCreator();

            if ($request->input('only_last_rev') == 1) {
                $docs = DB::table('unf_status')
                    ->join('max_rev_table', function ($join) {
                        $join->on('6464', '=', 'max_rev_table.project');
                        $join->on('unf_status.name', '=', 'max_rev_table.name');
                        $join->on('unf_status.revision', '=', 'max_rev_table.revision');
                    })
                    ->where($queryCreator->make($request))
                    ->get();
            } else {
                $docs = DB::table('unf_status')
                    ->where($queryCreator->make($request))
                    ->get();
            }


            return view('status.unf.result', compact('docs'));
        }
    }

    public function getSinglePdf($id)
    {
        $docNameCreator = new PdfCommentDocumentNameCreator();
        $path = $docNameCreator->name($this->getDocumentById($id));

        return response()
            ->make(file_get_contents($path), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    private function getDocumentById($id)
    {
        return DocumentController::where('id', $id)->firstOrFail();
    }

}
