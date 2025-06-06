<?php

namespace App\Models;

use CodeIgniter\Model;

class HonorariumInformationModel extends Model
{

    protected $table              = 'honorarium_information';
    protected $primaryKey         = 'id';
    protected $allowedFields      = ['training_institute_id', 'department_name', 'previous_training_inmonth', 'eligible_status', 'eligiblity_date', 'eligible_by', 'reject_reason', 'rejected_by', 'reject_date', 'remarks'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $returnType         = \App\Entities\HonorariumInformation::class;
    protected $useSoftDeletes     = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $helper;

    public function __construct()
    {
        parent::__construct();
        helper('datatable');
    }

    public function getSlots()
    {
        return $this->db->table('honorarium_slot')->where('status', true)->get()->getResultArray();
    }

    public function getStatistics($honorariumYear, $honorariumSession)
    {
        $builder = $this->db->table('honorarium_information');
        $builder->select('SUM(CASE WHEN eligible_status = "P" THEN 1 ELSE 0 END) as Pending, SUM(CASE WHEN eligible_status = "Y" THEN 1 ELSE 0 END) as Eligible, SUM(CASE WHEN eligible_status = "N" THEN 1 ELSE 0 END) as Rejected');
        $builder->where('honorarium_year', $honorariumYear);
        $builder->where('honorarium_slot_id', $honorariumSession);

        return $builder->get()->getRowArray();
    }

    public function getHonorarium($honorariumId)
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->select('hi.id, hi.applicant_id, hi.bmdc_reg_no, hi.training_institute_id, ti.name AS training_institute_name, hi.department_name, hi.honorarium_year, hi.previous_training_inmonth, hi.honorarium_position, hi.eligible_status AS bill_eligible_status, hi.bill_sl_no, hi.eligiblity_date, hi.honorarium_slot_id, ap.*, hs.slot_name, bnk.bank_name AS new_bank_name');
        $builder->join('applicant_information ap', 'hi.applicant_id = ap.applicant_id', 'left');
        $builder->join('honorarium_slot hs', 'hi.honorarium_slot_id = hs.id', 'left');
        $builder->join('institute ti', 'hi.training_institute_id = ti.institute_id', 'left');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');
        $builder->where('hi.id', $honorariumId);

        return $builder->get()->getRowArray();
    }

    /**
     * @param false|string $searchValue
     *
     * @return array|null
     */
    public function getHonorariums($searchValue = '', $start = 0, $length = 10, $honorariumYear = 2024, $honorariumSession = 2)
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->select('hi.id, hi.applicant_id, UPPER(ap.name) as name, UPPER(ap.father_spouse_name) as father_spouse_name, ap.fcps_reg_no, hi.bmdc_reg_no, hs.slot_name, hi.honorarium_year, hi.eligible_status, hi.bill_sl_no');
        $builder->join('applicant_information ap', 'hi.applicant_id = ap.applicant_id', 'left');
        $builder->join('honorarium_slot hs', 'hi.honorarium_slot_id = hs.id', 'left');
        $builder->where('hi.honorarium_year', $honorariumYear);
        $builder->where('hi.honorarium_slot_id', $honorariumSession);
        $builder->orderBy('hi.eligible_status', 'ASC');
        $builder->orderBy('hi.bill_sl_no', 'ASC');

        // Apply search filter
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
                ->orLike('ap.mother_name', $searchValue)
                ->orLike('hi.bmdc_reg_no', $searchValue)
                ->groupEnd();
        }

        // Limit and offset
        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function countAllHonorariums($honorariumYear, $honorariumSession)
    {
        $builder = $this->db->table('honorarium_information');
        $builder->where('honorarium_year', $honorariumYear);
        $builder->where('honorarium_slot_id', $honorariumSession);

        return $builder->countAllResults();

        //return $this->db->table('honorarium_information')->countAll();
    }

    public function countFilteredHonorariums($searchValue = '', $honorariumYear = new date("Y"), $honorariumSession = 1)
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->join('applicant_information ap', 'hi.applicant_id = ap.applicant_id', 'left');
        $builder->where('hi.honorarium_year', $honorariumYear);
        $builder->where('hi.honorarium_slot_id', $honorariumSession);

        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('ap.name', $searchValue)
                ->orLike('ap.father_spouse_name', $searchValue)
                ->orLike('hi.bmdc_reg_no', $searchValue)
                ->groupEnd();
        }

        return $builder->countAllResults();
    }

    public function getBillInfos($where = [])
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->select('hi.id, hi.applicant_id, hi.bill_sl_no, ap.name, ap.mobile, hi.bmdc_reg_no, ap.fcps_reg_no, ap.date_of_birth, ap.nid, ap.fcps_speciallity,
            ap.fcps_year, ap.fcps_month, ap.gander, hi.training_institute_id, ti.name AS training_institute_name, hi.department_name, hi.previous_training_inmonth,
            hi.honorarium_position, bnk.bank_name AS new_bank_name, ap.branch_name, ap.account_no, ap.routing_number, hi.honorarium_year,  hi.honorarium_slot_id, hs.slot_name, hi.eligible_status');
        $builder->join('applicant_information ap', 'hi.applicant_id = ap.applicant_id', 'left');
        $builder->join('honorarium_slot hs', 'hi.honorarium_slot_id = hs.id', 'left');
        $builder->join('institute ti', 'hi.training_institute_id = ti.institute_id', 'left');
        $builder->join('banks bnk', 'ap.bank_id = bnk.id', 'left');
        $builder->orderBy('hi.bill_sl_no', 'ASC');

        if (!empty($where)) {
            $builder->where($where);
        }

        return $builder->get()->getResultArray();
    }

    public function approveHonorarium($honorariumId)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('honorarium_information');
        $builder->where('id', $honorariumId);
        $builder->update(['eligible_status' => 'Y', 'eligible_by' => $user->id, 'eligiblity_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

    public function rejectHonorarium($honorariumId, $rejectReason)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('honorarium_information');
        $builder->where('id', $honorariumId);
        $builder->update(['eligible_status' => 'N', 'reject_reason' => $rejectReason, 'rejected_by' => $user->id, 'reject_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

    public function exportBillInformation($honorariumYear, $honorariumSession)
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->select('hi.*, UPPER(ap.name) as name, UPPER(ap.father_spouse_name) as father_spouse_name, hs.slot_name, hi.honorarium_year');
        $builder->join('applicant_information ap', 'hi.applicant_id = ap.applicant_id', 'left');
        $builder->join('honorarium_slot hs', 'hi.honorarium_slot_id = hs.id', 'left');
        $builder->where('hi.honorarium_year', $honorariumYear);
        $builder->where('hi.honorarium_slot_id', $honorariumSession);

        return $builder->get()->getResultArray();
    }
}
