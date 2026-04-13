<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;
use App\Models\SpecialityModel;

class PartOneController extends BaseController
{
    protected $fcpsPartOneModel;
    protected $specialityModel;

    public function __construct()
    {
        $this->fcpsPartOneModel = new FcpsPartOneModel();
        $this->specialityModel  = new SpecialityModel();
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

        //dd($candidate);

        if (!$candidate) {
            return redirect()->back()->with('error', 'This information is not found');
        }

        $data = [
            'title'        => 'Edit Candidate',
            'pageTitle'    => 'Edit Part-I Passed Candidate',
            'specialities' => $this->specialityModel->where('status', true)->findAll(),
            'candidate'    => $candidate,
        ];

        return view('Partone/edit', $data);
    }

    public function updatePart1Info()
    {
        // Check if the authenticated user has the 'bills.approve' permission
        if (!auth()->user()->can('partone.candidate.part1.update')) {
            // User does not have permission, so deny access.
            //return redirect()->to('/403');
            return redirect()->to('/403')->with('error', 'You are not authorized to update FCPS Part-I Information.');
            //return $this->response->setJSON(['status' => 'error', 'message' => 'You are not authorized to update bills.']);
        }

        $request = service('request');

        $candidateId = $request->getPost('id');

        if (!$candidateId) {
            return redirect()->to(base_url('fcps-part-one/edit-part1-passed-candidate/' . $candidateId))->with('error', 'Invalid ID.');
        }

        // Update FCPS information
        $data = [
            'fcps_reg_no' => $request->getPost('bcpsRegNo'),
            'fcps_roll'   => $request->getPost('fcpcRollNo'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'updated_by'  => service('auth')->user()->id,
        ];

        if (!$this->validateData($data, [
            'fcps_reg_no' => [
                'label'  => 'NID',
                'rules'  => 'required|exact_length[10]',
                'errors' => [
                    'required'     => 'Online Registration No. is required.',
                    'exact_length' => 'Online Registration No. must be 10 digits in length.',
                ],
            ],
        ])) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('errors', $this->validator->getErrors());
        }

        $isValidRegNo = $this->applicationModel->checkBcpsRegNo($request->getPost('bcpsRegNo'));

        if (!$isValidRegNo) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Online Registration No. is not valid.');
        }

        $checkAlreadyExists = $this->applicationModel->checkBcpsRegiAlreadyUsed($request->getPost('bcpsRegNo'));
        if ($checkAlreadyExists) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Online Registration No. is already used by another applicant.');
        }

        if ($this->applicationModel->update($applicantId, $data)) {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('success', 'FCPS Information updated successfully.');
        } else {
            return redirect()->to(base_url('applications/edit/' . $applicantId))->with('error', 'Failed to update FCPS information.');
        }
    }

}
