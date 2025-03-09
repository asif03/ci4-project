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
        $builder->select('ap.applicant_id, ap.name, ap.father_spouse_name, ap.eligible_status, bnk.bank_name');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');

        // Apply search filter
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
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
                ->groupEnd();
        }

        return $builder->countAllResults();
    }
}