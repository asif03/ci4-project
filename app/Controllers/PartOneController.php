<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;

class PartOneController extends BaseController
{
    protected $fcpsPartOneModel;

    public function __construct()
    {
        $this->fcpsPartOneModel = new FcpsPartOneModel();
    }

    /**
     * FCPS Part-I Passed Student List
     */
    public function index()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('partone.list')) {
            // User does not have permission, so deny access.
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        $data = [
            'title'     => 'FCPS Part-I',
            'pageTitle' => 'FCPS Part-I Passed Candidates',
        ];

        return view('Partone/index', $data);
    }

    public function getSearchedCandidates()
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

        $data = $this->fcpsPartOneModel->getData($searchValue, $start, $length);

        $response = [
            "draw"            => intval($draw),
            "recordsTotal"    => $data['totalRecords'],
            "recordsFiltered" => $data['totalSearchRecords'],
            "data"            => $data['candidates'],
        ];

        return $this->response->setJSON($response);
    }

    public function getCandidateByRegNo($regNo)
    {
        $candidate = $this->fcpsPartOneModel->getPartOneTraineeByRegNo($regNo);

        // Check if the authenticated user has the 'partone.candidate.show' permission
        if (!auth()->user()->can('partone.candidate.show')) {
            // User does not have permission, so deny access.
            return redirect()->to('/403')->with('error', 'You are not authorized to access this information.');
        }

        if (!$candidate) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Candidate not found']);
        }

        return view('Partone/show', $candidate);

    }

    public function edit($regNo)
    {
        // Check if the authenticated user has the 'partone.candidate.edit' permission
        if (!auth()->user()->can('partone.candidate.edit')) {
            // User does not have permission, so deny access.
            return redirect()->to('/403')->with('error', 'You are not authorized to edit this information.');
        }

        $candidate = $this->fcpsPartOneModel->getPartOneTraineeByRegNo($regNo);

        if (!$candidate) {
            return redirect()->back()->with('error', 'This information is not found');
        }

        $data = [
            'title'     => 'Edit Candidate',
            'pageTitle' => 'Edit Part-I Passed Candidate',
            'candidate' => $candidate,
        ];

        return view('Partone/edit', $data);
    }

}
