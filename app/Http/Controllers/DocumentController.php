<?php

namespace App\Http\Controllers;

use App\Utils\DocumentNameCreator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Document;
use Form;
use DB;

use App\Utils\PdfDocumentNameCreator;
use App\Utils\DwgDocumentNameCreator;
use App\Utils\ArchiveStorage;
use App\Utils\QueryCreator\DocumentWhereQueryCreator;

class DocumentController extends Controller
{

    public function index()
    {
        return view('documents.index');
    }

    public function search(Request $request)

    {
        $queryCreator = new DocumentWhereQueryCreator();

        if ($request->input('only_last_rev') == 1) {
            $docs = DB::table('documents')
                ->join('max_rev_table', function ($join) {
                    $join->on('documents.project', '=', 'max_rev_table.project');
                    $join->on('documents.name', '=', 'max_rev_table.name');
                    $join->on('documents.revision', '=', 'max_rev_table.revision');
                })
                ->where($queryCreator->make($request))
                ->get();
        } else {
            $docs = DB::table('documents')
                ->where($queryCreator->make($request))
                ->get();
        }


        return view('documents.result', compact('docs'));
    }


    public function getSinglePdf($id)
    {
        $docNameCreator = new PdfDocumentNameCreator();
        $path = $docNameCreator->name(self::getDocumentById($id));

        return response()
            ->make(file_get_contents($path), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }

    public function getSingleDwg($id)
    {
        $docNameCreator = new DwgDocumentNameCreator();
        $path = $docNameCreator->name(self::getDocumentById($id));

        return response()->download($path, basename($path), ['Content-Type: application/octet-stream']);
    }

    public static function getDocumentById($id)
    {
        return Document::where('id', $id)->firstOrFail();
    }

    public function zipManyPdf(Request $request)
    {
        return $this->zipMany($request, new PdfDocumentNameCreator());
    }

    public function zipManyDwg(Request $request)
    {
        return $this->zipMany($request, new DwgDocumentNameCreator());
    }

    public function zipMany(Request $request, DocumentNameCreator $nameCreator)
    {
        set_time_limit(config('filesystems.archiveCreationTime'));

        $zipStorage = new ArchiveStorage();

        $zipStorage->clean();

        $idList = json_decode($request->input('list'));

        $files = [];

        foreach ($idList as $id) {
            $doc = self::getDocumentById($id);

            $files[] = $nameCreator->name($doc);
        }

        $zipPath = config('filesystems.archiveStoragePath') . DIRECTORY_SEPARATOR . 'drawings_' . uniqid() . '.zip';

        if ($zipStorage->createArchive($files, $zipPath) === TRUE) {
            return basename($zipPath);
        } else {
            return "";
        }
    }

}
