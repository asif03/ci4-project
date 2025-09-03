<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;
use App\Models\ProgressReportModel;

class TrainingController extends BaseController
{
    protected $fcpsPartOneModel;
    protected $progressReportModel;

    public function __construct()
    {

        $this->progressReportModel = new ProgressReportModel();
        $this->fcpsPartOneModel    = new FcpsPartOneModel();
    }

    /**
     * FCPS Part-I Passed Student List
     */
    public function index()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.list')) {
            // User does not have permission, so deny access.
            return redirect()->to('/401')->with('error', 'You are not authorized to access this page !');
        }

        $data = [
            'title'     => 'FCPS Part-I',
            'pageTitle' => 'FCPS Part-I Passed Candidates',
            //'statistics' => $statisticsData,
        ];

        return view('Partone/index', $data);
    }

    public function trainees()
    {
        $data = [
            'title'     => 'FCPS Part-I Trainees',
            'pageTitle' => 'FCPS Part-I Passed Trainees',
            //'statistics' => $statisticsData,
        ];

        return view('Training/index', $data);
    }

    public function getSearchedTrainees()
    {
        $request = service('request');

        // Get DataTables parameters
        $draw        = $request->getPost('draw');
        $start       = $request->getPost('start');
        $length      = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        /*draw        = 1;
        $start       = 1;
        $length      = 10;
        $searchValue = 'Asif';*/

        $data = $this->progressReportModel->getData($searchValue, $start, $length);

        $response = [
            "draw"            => intval($draw),
            "recordsTotal"    => $data['totalRecords'],
            "recordsFiltered" => $data['totalSearchRecords'],
            "data"            => $data['candidates'],
        ];

        return $this->response->setJSON($response);
    }

    public function getTrainee($id)
    {
        $traineeDetails = $this->fcpsPartOneModel->find($id);

        //dd($traineeDetails);

        $data = [
            'title'         => 'FCPS Part-I Trainees',
            'pageTitle'     => 'FCPS Part-I Passed Trainees',
            'traineeDetail' => $traineeDetails,
        ];

        return view('Training/progress-reports', $data);
    }

}
