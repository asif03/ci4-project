<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Models\HonorariumInformationModel;
use App\Models\HonorariumSlotModel;
use App\Models\InstituteModel;
use App\Models\SpecialityModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function downloadHonorariumForm()
    {
        $request = service('request');

        $honorariumId = $request->getPost('honorariumId');

        $honorariumId = 1;

        $honorarium = $this->honorariumModel->getHonorarium($honorariumId);

        return view('Honorarium/pdf_form', ['honorarium' => $honorarium]);

        if ($honorarium) {
            $dompdf = new Dompdf();
            $html   = view('Honorarium/pdf_form', ['honorarium' => $honorarium]);
            $dompdf->setOptions(new \Dompdf\Options(['isRemoteEnabled' => true]));
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('honorarium_' . $honorariumId . '.pdf', ['Attachment' => true]);

        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Honorarium not found.']);
        }
    }

    public function exportExcel()
    {
        $file_name       = 'data.xlsx';
        $spreadsheet     = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");

        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length:' . filesize($file_name));

        flush();

        readfile($file_name);

        exit;

        /*$honorariums = $this->honorariumModel->exportBillInformation();

    $file_name = 'data.xlsx';

    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Employee Name');

    $sheet->setCellValue('B1', 'Email Address');

    $sheet->setCellValue('C1', 'Mobile No.');

    $sheet->setCellValue('D1', 'Department');

    $count = 2;

    foreach ($honorariums as $row) {
    $sheet->setCellValue('A' . $count, $row['employee_name']);

    $sheet->setCellValue('B' . $count, $row['employee_email']);

    $sheet->setCellValue('C' . $count, $row['employee_mobile']);

    $sheet->setCellValue('D' . $count, $row['employee_department']);

    $count++;
    }

    $writer = new Xlsx($spreadsheet);

    $writer->save($file_name);

    header("Content-Type: application/vnd.ms-excel");

    header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

    header('Expires: 0');

    header('Cache-Control: must-revalidate');

    header('Pragma: public');

    header('Content-Length:' . filesize($file_name));

    flush();

    readfile($file_name);

    exit;*/
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