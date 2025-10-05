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
        $traineeDetails  = $this->fcpsPartOneModel->find($id);
        $progressReports = $this->progressReportModel->getProgressReportByRegNo($traineeDetails['reg_no']);

        //dd($progressReports);

        $data = [
            'title'           => 'FCPS Part-I Trainees',
            'pageTitle'       => 'FCPS Part-I Passed Trainees',
            'traineeDetails'  => $traineeDetails,
            'progressReports' => $progressReports,
        ];

        return view('Training/progress-reports', $data);
    }

    public function approveProgressReport()
    {
        $request = service('request');

        $reportId = $request->getPost('reportId');

        $isApproved = $this->progressReportModel->approveProgressReport($reportId);

        if ($isApproved) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Approved successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to approve.']);
        }
    }

    public function receiveProgressReport()
    {
        $request = service('request');

        $reportId = $request->getPost('reportId');

        $isApproved = $this->progressReportModel->receiveProgressReport($reportId);

        if ($isApproved) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Receive successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to receive.']);
        }
    }
}