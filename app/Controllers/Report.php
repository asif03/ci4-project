<?php

namespace App\Controllers;

use App\Models\BankModel;
use App\Models\HonorariumInformationModel;
use App\Models\HonorariumSlotModel;
use App\Models\InstituteModel;
use App\Models\SpecialityModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
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

    public function applications()
    {
        $data = [
            'title'           => 'Application Report',
            'pageTitle'       => 'Application Report',
            'pageDescription' => 'Generate reports for applications.',
        ];

        return view('Reports/application', $data);
    }

    public function bills()
    {
        $data = [
            'title'     => 'Bill Report',
            'pageTitle' => 'Bill Report',
            'slots'     => $this->honorariumModel->getSlots(),
        ];

        return view('Reports/bill', $data);
    }

    public function exportBillToExcel()
    {
        $honorariumYear = $this->request->getPost('honorariumYear');
        $honorariumSlot = $this->request->getPost('honorariumSession');

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        //headers
        $sheet->setCellValue('A1', 'Bill Sl No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Mobile');
        $sheet->setCellValue('D1', 'BMDC Reg No');
        $sheet->setCellValue('E1', 'Online Reg No');
        $sheet->setCellValue('F1', 'Date of Birth');
        $sheet->setCellValue('G1', 'NID');
        $sheet->setCellValue('H1', 'FCPS Speciallity');
        $sheet->setCellValue('I1', 'FCPS Session');
        $sheet->setCellValue('J1', 'FCPS Year');
        $sheet->setCellValue('K1', 'Gander');
        $sheet->setCellValue('L1', 'Institute Name');
        $sheet->setCellValue('M1', 'Department Name');
        $sheet->setCellValue('N1', 'Total Previous Training');
        $sheet->setCellValue('O1', 'Applied for Hornorarium');
        $sheet->setCellValue('P1', 'Bank Name');
        $sheet->setCellValue('Q1', 'Branch Name');
        $sheet->setCellValue('R1', 'Account No');
        $sheet->setCellValue('S1', 'Routing No');
        $sheet->setCellValue('T1', 'Honorarium Year');
        $sheet->setCellValue('U1', 'Honorarium Session');
        //$sheet->setCellValue('T1', 'Remarks');

        // Fetching additional data for each user
        $data = $this->honorariumModel->getBillInfos([
            'hi.honorarium_year'    => $honorariumYear,
            'hi.honorarium_slot_id' => $honorariumSlot,
        ]);

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['bill_sl_no']);
            $sheet->setCellValue('B' . $row, $item['name']);
            $sheet->setCellValue('C' . $row, $item['mobile']);
            $sheet->setCellValue('D' . $row, $item['bmdc_reg_no']);
            $sheet->setCellValueExplicit('E' . $row, $item['fcps_reg_no'], DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $item['date_of_birth']);
            $sheet->setCellValueExplicit('G' . $row, $item['nid'], DataType::TYPE_STRING);
            $sheet->setCellValue('H' . $row, $item['fcps_speciallity']);
            $sheet->setCellValue('I' . $row, $item['fcps_month']);
            $sheet->setCellValue('J' . $row, $item['fcps_year']);
            $sheet->setCellValue('K' . $row, $item['gander']);
            $sheet->setCellValue('L' . $row, $item['training_institute_name']);
            $sheet->setCellValue('M' . $row, $item['department_name']);
            $sheet->setCellValue('N' . $row, $item['previous_training_inmonth']);
            $sheet->setCellValue('O' . $row, $item['honorarium_position']);
            $sheet->setCellValue('P' . $row, $item['new_bank_name']);
            $sheet->setCellValue('Q' . $row, $item['branch_name']);
            $sheet->setCellValueExplicit('R' . $row, $item['account_no'], DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('S' . $row, $item['routing_number'], DataType::TYPE_STRING);
            $sheet->setCellValue('T' . $row, $item['honorarium_year']);
            $sheet->setCellValue('U' . $row, $item['slot_name']);

            $row++;
        }

        // Output file
        $filename = 'Report_' . $honorariumYear . $honorariumSlot . '_' . date('Y-m-d h:i:sa') . '.xlsx';

        // Send headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}
