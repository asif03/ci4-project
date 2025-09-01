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

    /*public function countAllData()
    {
    return $this->db->table('applicant_information')->countAll();
    }*/

    public function getApplicantById($applicantId)
    {
        $builder = $this->db->table('applicant_information ap');
        $builder->select('ap.*, bnk.bank_name');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');
        $builder->where('ap.applicant_id', $applicantId);

        return $builder->get()->getRowArray();
    }

    public function checkBcpsRegNo($bcpsRegNo)
    {
        $builder = $this->db->table('fcps_one_pass_applicants');
        $builder->where('reg_no', $bcpsRegNo);

        return $builder->countAllResults() > 0;
    }

    public function checkBcpsRegiAlreadyUsed($bcpsRegNo)
    {
        $builder = $this->db->table('applicant_information');
        $builder->where('fcps_reg_no', $bcpsRegNo);

        return $builder->countAllResults() > 0;
    }

    public function getAttachements($applicantId)
    {
        $builder = $this->db->table('applicant_files');
        $builder->select('fiile_id, file_name, type');
        $builder->where('applicant_id', $applicantId);

        return $builder->get()->getResultArray();
    }

    public function approveApplicant($applicantId)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('applicant_information');
        $builder->where('applicant_id', $applicantId);
        $builder->update(['eligible_status' => 'Y', 'eligible_by' => $user->username, 'eligiblity_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

    public function rejectApplicant($applicantId, $rejectReason)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('applicant_information');
        $builder->where('applicant_id', $applicantId);
        $builder->update(['eligible_status' => 'N', 'reject_reason' => $rejectReason, 'rejected_by' => $user->username, 'reject_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

    public function getApplicationInfos($where = [])
    {
        $builder = $this->db->table('applicant_information ap');
        $builder->select('ap.applicant_id, UPPER(ap.name) as name, ap.father_spouse_name, ap.mother_name, ap.date_of_birth, ap.bmdc_reg_no, ap.address, ap.gander,
            ap.bmdc_validity, ap.fcps_reg_no, ap.fcps_speciallity, ap.fcps_year, ap.fcps_month, ap.nid, ap.mobile, ap.email, ap.created, bnk.bank_name, ap.branch_name,
            ap.account_no, ap.routing_number, ap.eligible_status');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');

        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $builder->where($key, $value);
            }
        }

        return $builder->get()->getResultArray();
    }

}
