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

    public function getStatistics()
    {
        $request = service('request');

        $honorariumYear    = $request->getPost('honorariumYear');
        $honorariumSession = $request->getPost('honorariumSession');

        //$honorariumYear    = 2025;
        //$honorariumSession = 2;

        $statistics = $this->honorariumModel->getStatistics($honorariumYear, $honorariumSession);

        $data = [
            'labels' => array_keys($statistics),
            'values' => array_values($statistics),
        ];

        echo json_encode($data);
        exit;
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

    public function approveHonorarium()
    {
        $request = service('request');

        $honorariumId = $request->getPost('honorariumId');

        $isApproved = $this->honorariumModel->approveHonorarium($honorariumId);

        if ($isApproved) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Approved successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to approve.']);
        }
    }

    public function rejectHonorarium()
    {
        $request = service('request');

        $honorariumId = $request->getPost('honorariumId');
        $rejectReason = $request->getPost('rejectReason');

        $isRejected = $this->honorariumModel->rejectHonorarium($honorariumId, $rejectReason);

        if ($isRejected) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Rejected successfully.']);
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