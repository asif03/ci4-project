<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantInformationModel extends Model
{
    protected $table      = 'applicant_information';
    protected $primaryKey = 'applicant_id';

    protected $allowedFields = ['name', 'father_spouse_name', 'mother_name', 'date_of_birth', 'nataionality', 'religion', 'nid',
        'address', 'mobile', 'telephone', 'email', 'permanent_address', 'fcps_reg_no', 'fcps_roll', 'mbbs_bds_year', 'mbbs_institute_id', 'mbbs_bds_institute',
        'bank_id', 'branch_name', 'account_no',
        'routing_number', 'updated_at', 'updated_by'];

    public function getStatistics()
    {
        $builder = $this->db->table('applicant_information');
        $builder->select('COUNT(applicant_id) as totalApplications');
        $totalApplications = $builder->get()->getRowArray();

        $builder->where('eligible_status', 'P');
        $builder->select('COUNT(applicant_id) as totalPendingApplications');
        $totalPendingApplications = $builder->get()->getRowArray();

        $builder->where('eligible_status', 'Y');
        $builder->select('COUNT(applicant_id) as totalVerifiedApplications');
        $totalVerifiedApplications = $builder->get()->getRowArray();

        $builder->where('eligible_status', 'N');
        $builder->select('COUNT(applicant_id) as totalRejectedApplications');
        $totalRejectedApplications = $builder->get()->getRowArray();

        return [
            'totalApplications'         => $totalApplications['totalApplications'],
            'totalPendingApplications'  => $totalPendingApplications['totalPendingApplications'],
            'totalVerifiedApplications' => $totalVerifiedApplications['totalVerifiedApplications'],
            'totalRejectedApplications' => $totalRejectedApplications['totalRejectedApplications'],
        ];
    }

    public function getData($searchValue = '', $start = 0, $length = 10)
    {
        $builder = $this->db->table('applicant_information ap');
        $builder->select('ap.applicant_id, UPPER(ap.name) as name, UPPER(ap.father_spouse_name) as father_spouse_name, UPPER(ap.mother_name) as mother_name, ap.bmdc_reg_no, ap.continuing_fcps_traning, ap.eligible_status, bnk.bank_name');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');
        //$builder->orderBy('ap.applicant_id', 'DESC');

        // Apply search filter
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
                ->orLike('ap.mother_name', $searchValue)
                ->orLike('ap.bmdc_reg_no', $searchValue)
                ->groupEnd();
        }

        // Limit and offset
        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function countAllData()
    {
        return $this->db->table('applicant_information')->countAll();
    }

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

    public function countFilteredData($searchValue = '')
    {
        $builder = $this->db->table('applicant_information ap');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
                ->orLike('ap.mother_name', $searchValue)
                ->orLike('ap.bmdc_reg_no', $searchValue)
                ->groupEnd();
        }

        return $builder->countAllResults();
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
}
