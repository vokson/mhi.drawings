<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\DocumentController;

use App\Http\Requests;
use App\Document;
use App\StatusUNF;
use Form;
use DB;

use App\Utils\PdfCommentDocumentNameCreator;
use App\Utils\JsonDocumentNameCreator;

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
            DB::table('max_rev_table')->insert((array)$row);
        }


        echo count($rows) . " maximum revisions have been chosen.";
    }


    public function statusInfoUpdateForUNF()
    {
        set_time_limit(300);

        DB::table('unf_status')->truncate();
        $docs = Document::where('project', '6464')->get();

        foreach ($docs as $doc) {

            $object = new StatusUNF();
            $object->id = $doc->id;
            $object->project = $doc->project;
            $object->name = $doc->name;
            $object->title = $doc->title;
            $object->revision = $doc->revision;
            $object->part = $doc->part;
            $object->path = $doc->path;
            $object->save();

        }

        $statuses = StatusUNF::all();

        $pdfNameCreator = new PdfCommentDocumentNameCreator();
        $jsonNameCreator = new JsonDocumentNameCreator();

        foreach ($statuses as $status) {

//            echo $pdfNameCreator->name($status) . "<br/>";

            if (file_exists($pdfNameCreator->name($status))) {
                $status->isPdfExist = true;
            }

            $jsonPath = $jsonNameCreator->name($status);

            if (file_exists($jsonPath)) {
                if ($jsonArray = json_decode(file_get_contents($jsonPath), true)) {

                    $info = $this->getJsonInfoForUNF($jsonArray);

                    if (is_null($info)) {
                        echo $jsonPath . " - JSON format is WRONG<br/>";

                    } else {
                        $status->approvedByDI = $info[0];
                        $status->letterFromDI = $info[1];
                        $status->approvedBySAC = $info[2];
                        $status->letterFromSAC = $info[3];
                    }

                } else {
                    echo $jsonPath . " - JSON can't be decoded<br/>";
                }
            } else {
                $status->approvedByDI = false;
                $status->letterFromDI = null;
                $status->approvedBySAC = false;
                $status->letterFromSAC = null;
            }

            $status->save();
        }

        echo count($statuses) . " statuses have been updated.";
    }

    private function getJsonInfoForUNF($jsonArray)
    {
        $isOK = true;

        $approvedByDI = false;
        if (isset($jsonArray['DI']['approved'])) {
            if ($jsonArray['DI']['approved'] == "yes" or $jsonArray['DI']['approved'] == "YES") {
                $approvedByDI = true;
            }
        } else $isOK = false;

        $approvedBySAC = false;
        if (isset($jsonArray['SAC']['approved'])) {
            if ($jsonArray['SAC']['approved'] == "yes" or $jsonArray['SAC']['approved'] == "YES") {
                $approvedBySAC = true;
            }
        } else $isOK = false;

        $letterFromDI = "";
        if (isset($jsonArray['DI']['letter'])) {
            $letterFromDI = $jsonArray['DI']['letter'];
        } else $isOK = false;

        $letterFromSAC = "";
        if (isset($jsonArray['SAC']['letter'])) {
            $letterFromSAC = $jsonArray['SAC']['letter'];
        } else $isOK = false;

        if ($isOK === true) {
            return [$approvedByDI, $letterFromDI, $approvedBySAC, $letterFromSAC];
        } else {
            return NULL;
        }

    }


    public
    function existInfoUpdateForTAF()
    {
        $this->existInfoUpdate('6417');
    }

    public
    function existInfoUpdateForRPA()
    {
        $this->existInfoUpdate('6453');
    }

    public
    function existInfoUpdateForUNF()
    {
        $this->existInfoUpdate('6464');
    }

    private
    function existInfoUpdate($project)
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

    public
    function rpa()
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

    public
    function taf()
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
