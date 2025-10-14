<?php

namespace App\Models;

use CodeIgniter\Model;

class FcpsPartOneModel extends Model
{
    protected $table      = 'fcps_one_pass_applicants';
    protected $primaryKey = 'id';

    protected $allowedFields = ['date_of_birth', 'mailing_address', 'present_address', 'permanent_address', 'national_id', 'pen_number',
        'subject_id', 'subject', 'contact_res', 'cell', 'tel_office', 'email', 'money_receipt_no', 'money_receipt_date', 'training_institute', 'roll',
        'mbbs_year', 'mbbs_institute_id', 'mbbs_institute', 'eligible_for_final_exam', 'training_completion', 'protocol_acceptance', 'dissertaion_acceptance',
        'created_by', 'updated_by', 'updated_at'];

    public function countFilteredData($searchValue = '')
    {
        $builder = $this->db->table('fcps_one_pass_applicants ap');
        $builder->join('speciality sp', 'ap.subject_id = sp.speciality_id', 'left');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.applicant_name', $searchValue)
                ->orLike('ap.father_name', $searchValue)
                ->orLike('ap.reg_no', $searchValue)
                ->orLike('ap.cell', $searchValue)
                ->groupEnd();
        }

        return $builder->countAllResults();
    }
    public function getData($searchValue = '', $start = 0, $length = 10)
    {
        $builder = $this->db->table('fcps_one_pass_applicants ap');
        $builder->select('ap.id, ap.fcps_part_one_year, ap.fcps_part_one_session, UPPER(ap.applicant_name) as name, UPPER(ap.father_name) as father_name, ap.pen_number, ap.reg_no, ap.cell, ap.email');
        $builder->join('speciality sp', 'ap.subject_id = sp.speciality_id', 'left');

        // Apply search filter
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.applicant_name', $searchValue)
                ->orLike('ap.father_name', $searchValue)
                ->orLike('ap.reg_no', $searchValue)
                ->orLike('ap.cell', $searchValue)
                ->groupEnd();
        }

        // Limit and offset
        $builder->limit($length, $start);

        $data['candidates']         = $builder->get()->getResultArray();
        $data['totalRecords']       = $this->db->table('fcps_one_pass_applicants')->countAll();
        $data['totalSearchRecords'] = $this->countFilteredData($searchValue);
        return $data;
    }

    public function getPartOneTraineeById($id)
    {
        $builder = $this->db->table('fcps_one_pass_applicants fcps');
        $builder->select('fcps.*, sp.name AS subject_name');
        $builder->join('speciality sp', 'fcps.subject_id = sp.speciality_id', 'left');
        $builder->where('fcps.id', $id);

        return $builder->get()->getRowArray();
    }

}
