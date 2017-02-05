<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\DocumentController;

use App\Http\Requests;
use App\Document;
use Form;
use DB;
use PDO;

use App\Utils\PdfDocumentNameCreator;
use App\Utils\DwgDocumentNameCreator;

class ServiceController extends Controller
{

    public function index()
    {
        return view('service.index');
    }

    public function maxRevUpdate()
    {
        DB::table('max_rev_table')->truncate();

        $rows = DB::table('documents')
            ->select(DB::raw('project, name, MAX(revision) as revision'))
            ->groupBy('project')
            ->groupBy('name')
            ->get()->toArray();

        foreach ($rows as $row) {
            DB::table('max_rev_table')->insert((array) $row);
        }



        echo count($rows) . " maximum revisions have been chosen.";
    }


    public function existInfoUpdateForTAF()
    {
        $this->existInfoUpdate('6417');
    }

    public function existInfoUpdateForRPA()
    {
        $this->existInfoUpdate('6453');
    }

    public function existInfoUpdateForUNF()
    {
        $this->existInfoUpdate('6464');
    }

    private function existInfoUpdate($project)
    {
        set_time_limit(300);

        $docs = Document::where('project', $project)->get();

        $pdfNameCreator = new PdfDocumentNameCreator();
        $dwgNameCreator = new DwgDocumentNameCreator();

        foreach ($docs as $doc) {

            if (file_exists($pdfNameCreator->name($doc))) {
                $doc->isPdfExist = true;
            }

            if (file_exists($dwgNameCreator->name($doc))) {
                $doc->isDwgExist = true;
            }

            $doc->save();
        }

        echo count($docs) . " documents have been updates.";
    }

    public function rpa()
    {
        set_time_limit(300);

        $docs = DB::connection('mysql_rpa')->select("select * from drawings");

        foreach ($docs as $doc) {
            $object = new Document();
            $object->project = $doc->project;
            $object->name = $doc->drawing;
            $object->revision = $doc->revision;
            $object->part = $doc->part;
            $object->status = $doc->drw_status;
            $object->title = $doc->title;

            $object->transmittal = $doc->transmit_in;
            $object->path = str_replace('\\', '/', $doc->path);

            $date = Carbon::createFromTimestamp($doc->date_in);
            $date->hour = 0;
            $date->minute = 0;
            $date->second = 0;
            $object->issued_at = $date;

            $object->save();
        }

        echo count($docs) . " documents have been added.";
    }

    public function taf()
    {
        set_time_limit(300);

        $docs = DB::connection('mysql_taf')->select("select * from drawings");

        foreach ($docs as $doc) {
            if ($doc->drawing[0] === "C") {
                $object = new Document();
                $object->project = $doc->project;
                $object->name = $doc->drawing;
                $object->revision = $doc->revision;
                $object->part = $doc->part;
                $object->status = $doc->drw_status;
                $object->title = $doc->title;

                $object->transmittal = $doc->transmit_in;
                $object->path = '6417/' . str_replace('\\', '/', $doc->path);

                $date = Carbon::createFromTimestamp($doc->date_in);
                $date->hour = 0;
                $date->minute = 0;
                $date->second = 0;
                $object->issued_at = $date;

                $object->save();
            }
        }

        echo count($docs) . " documents have been added.";
    }
}
