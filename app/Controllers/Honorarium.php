<?php

namespace App\Controllers;

use App\Models\HonorariumInformationModel;

class Honorarium extends BaseController
{
    protected $honorariumModel;

    public function __construct()
    {
        $this->honorariumModel = new HonorariumInformationModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Honorarium',
            'pageTitle'   => 'Bills Information',
            'slots'       => $this->honorariumModel->getSlots(),
            'honorariums' => $this->honorariumModel->getHonorariums(),
        ];

        return view('Honorarium/index', $data);
    }

    public function getSearchedHonorariums()
    {
        $request = service('request');

        // Get DataTables parameters
        $draw              = $request->getPost('draw');
        $start             = $request->getPost('start');
        $length            = $request->getPost('length');
        $searchValue       = $request->getPost('search')['value'];
        $honorariumYear    = $request->getPost('honorariumYear');
        $honorariumSession = $request->getPost('honorariumSession');

        // Fetch data from model
        $data          = $this->honorariumModel->getHonorariums($searchValue, $start, $length, $honorariumYear, $honorariumSession);
        $totalRecords  = $this->honorariumModel->countAllHonorariums();
        $totalFiltered = $this->honorariumModel->countFilteredHonorariums($searchValue);

        $response = [
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function approveApplicant()
    {
        $request = service('request');

        $honorariumId = $request->getPost('honorariumId');

        $isApproved = $this->honorariumModel->approveApplicant($honorariumId);

        if ($isApproved) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Applicant approved successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to approve applicant.']);
        }
    }

    public function rejectApplicant()
    {
        $request = service('request');

        $applicantId  = $request->getPost('applicantId');
        $rejectReason = $request->getPost('rejectReason');

        $isRejected = $this->applicationModel->rejectApplicant($applicantId, $rejectReason);

        if ($isRejected) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Applicant rejected successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to reject applicant.']);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Add Honorarium',
        ];

        return view('Honorarium/create', $data);
    }

    public function store()
    {
        $this->honorariumModel->save([
            'honorarium_name'   => $this->request->getPost('honorarium_name'),
            'honorarium_amount' => $this->request->getPost('honorarium_amount'),
            'honorarium_date'   => $this->request->getPost('honorarium_date'),
            'honorarium_status' => $this->request->getPost('honorarium_status'),
        ]);

        return redirect()->to('/honorariums');
    }

    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Honorarium',
            'honorarium' => $this->model->find($id),
        ];

        return view('Honorarium/edit', $data);
    }

    public function update($id)
    {
        $this->honorariumModel->save([
            'id'                => $id,
            'honorarium_name'   => $this->request->getPost('honorarium_name'),
            'honorarium_amount' => $this->request->getPost('honorarium_amount'),
            'honorarium_date'   => $this->request->getPost('honorarium_date'),
            'honorarium_status' => $this->request->getPost('honorarium_status'),
        ]);

        return redirect()->to('/honorariums');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/honorariums');
    }
}

//431354