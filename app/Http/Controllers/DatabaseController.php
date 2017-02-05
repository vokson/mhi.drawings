<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Utils\PathCreator;
use App\Document;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('service.upload');
    }

    public function upload(Request $request)
    {
        if ($request->input('project') === 'UNF' && $request->input('filetype') === 'EXCEL') {
            $this->uploadUnfByExcel($request);
        } else {
            echo 'Wrong Uploader';
        }
    }

    protected function uploadUnfByExcel(Request $request)
    {
        Excel::load($request->file('file'), function ($reader) {

            $results = $reader->select([
                'mhi_drawing_no',
                'rev',
                'part',
                'title',
                'issue_a',
                'status',
                'transmittal_no'
            ])->toArray();

            $pathCreator = new PathCreator();


            $filesAdded = 0;

            foreach ($results as $row) {

                $project = substr($row['mhi_drawing_no'], 0, 4);
                $drawing = substr($row['mhi_drawing_no'], 5);
                $revision = $row['rev'];
                $part = $row['part'];

                if (!$this->isDocumentExist($project, $drawing, $revision, $part)) {



                    $this->addDocument($project, $drawing, $revision, $part,
                        $row['status'], $row['title'], $row['transmittal_no'],
                        $pathCreator->makePathForUnfProject($project, $drawing), 0, 0,
                        $row['issue_a']
                    );

                    $filesAdded++;

                }

            }

            echo $filesAdded . ' rows have been added successfully.';

        });
    }

    private function isDocumentExist($project, $drawing, $revision, $part)
    {
        $existingRows = DB::table('documents')
            ->where('project', $project)
            ->where('name', $drawing)
            ->where('revision', (string)$revision)
            ->where('part', (string)$part)
            ->first();

        return ($existingRows !== null);
    }

    private function addDocument($project, $drawing, $revision, $part, $status, $title, $transmittal, $path, $isPdfExist, $isDwgExist, $issued_at)
    {
        $object = new Document();

        $object->project = $project;
        $object->name = $drawing;
        $object->revision = $revision;
        $object->part = $part;
        $object->status = $status;
        $object->title = $title;
        $object->transmittal = $transmittal;
        $object->path = $path;
        $object->isPdfExist = $isPdfExist;
        $object->isDwgExist = $isDwgExist;
        $object->issued_at = $issued_at;

        $object->save();
    }

}
