<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantInformationModel extends Model
{
    protected $table      = 'applicant_information';
    protected $primaryKey = 'applicant_id';

    public function getData($searchValue = '', $start = 0, $length = 10)
    {
        $builder = $this->db->table('applicant_information ap');
        $builder->select('ap.applicant_id, UPPER(ap.name) as name, UPPER(ap.father_spouse_name) as father_spouse_name, UPPER(ap.mother_name) as mother_name, ap.bmdc_reg_no, ap.eligible_status, bnk.bank_name');
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
}