<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Models\HonorariumInformationModel;
use App\Models\HonorariumSlotModel;
use App\Models\InstituteModel;
use App\Models\SpecialityModel;
use Dompdf\Dompdf;

class Honorarium extends BaseController
{
    protected $honorariumModel;
    protected $specialityModel;
    protected $HonorariumSlotModel;
    protected $instituteModel;
    protected $bankModel;

    public function __construct()
    {
        $this->honorariumModel     = new HonorariumInformationModel();
        $this->specialityModel     = new SpecialityModel();
        $this->HonorariumSlotModel = new HonorariumSlotModel();
        $this->instituteModel      = new InstituteModel();
        $this->bankModel           = new BankModel();
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
        $request    = service('request');
        $jsonParams = $request->getJSON();

        // Access data
        $honorariumYear    = $jsonParams->honorariumYear ?? null;
        $honorariumSession = $jsonParams->honorariumSession ?? null;

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
        $totalRecords  = $this->honorariumModel->countAllHonorariums($honorariumYear, $honorariumSession);
        $totalFiltered = $this->honorariumModel->countFilteredHonorariums($searchValue, $honorariumYear, $honorariumSession);

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

    public function getHonorarium($id)
    {
        $honorarium = $this->honorariumModel->getHonorarium($id);

        $data = [
            'title'      => 'Bill Details',
            'honorarium' => $honorarium,
        ];

        if ($honorarium) {
            return view('Honorarium/view_details', $data);
        } else {
            echo 'Honorarium not found.';
        }
    }

    public function getBillInfo($id)
    {
        $honorarium = $this->honorariumModel->getHonorarium($id);

        $data = [
            'title'      => 'Bill Details',
            'speciality' => $this->specialityModel->findAll(),
            'slots'      => $this->HonorariumSlotModel->findAll(),
            'institute'  => $this->instituteModel->where('status', true)->where('honorarium_status', true)->findAll(),
            'banks'      => $this->bankModel->findAll(),
            'honorarium' => $honorarium,
        ];

        if ($honorarium) {
            return view('Honorarium/edit', $data);
        } else {
            echo 'Honorarium not found.';
        }
    }

    public function downloadHonorariumForm($honorariumId)
    {
        //$request      = service('request');
        //$honorariumId = $request->getPost('honorariumId');
        $honorarium = $this->honorariumModel->getHonorarium($honorariumId);

        //return view('Honorarium/pdf_form', ['honorarium' => $honorarium]);

        if ($honorarium) {
            $dompdf = new Dompdf();
            $html   = view('Honorarium/pdf_form', ['honorarium' => $honorarium]);
            $dompdf->setOptions(new \Dompdf\Options(['isRemoteEnabled' => true]));
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('honorarium_' . $honorarium['bmdc_reg_no'] . $honorariumId . '.pdf', ['Attachment' => true]);

        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Honorarium not found.']);
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

    public function update($honorariumId)
    {
        $request   = service('request');
        $updatedId = $request->getPost('honorariumId');

        if (!$updatedId) {
            return redirect()->back()->with('error', 'Invalid applicant ID.');
        }

        // Update applicant information
        $data = [
            'training_institute_id'     => $request->getPost('trainingInstitute'),
            'department_name'           => $request->getPost('department'),
            'previous_training_inmonth' => $request->getPost('previousTrainingPeriod'),
            'updated_at'                => date('Y-m-d H:i:s'),
            'updated_by'                => service('auth')->user()->id,
        ];

        if ($this->honorariumModel->update($updatedId, $data)) {
            return redirect()->to('/bills')->with('success', 'Basic Information updated successfully.');
        } else {
            return redirect()->back()->with('errors', 'Failed to update honorarium information.');
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/honorariums');
    }
}
