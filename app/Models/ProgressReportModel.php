<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressReportModel extends Model
{
    protected $table      = 'progress_reports';
    protected $primaryKey = 'id';

    protected $allowedFields = ['reg_no', 'training_start_date', 'training_end_date', 'countable_duration_month', 'training_accepted', 'progress_report_received',
        'progress_report_url', 'training_institute_id', 'institute_p2_training', 'supervisor_id', 'supervisor_name', 'department_id', 'supervisor_department', 'no_of_beds',
        'no_of_trainees', 'no_of_faculty_mem', 'designation_id', 'supervisor_designation', 'subject_id', 'supervisor_subject', 'supervisor_mobile_no', 'supervisor_mailing_address',
        'attendance', 'knowledge', 'skill', 'attitude', 'status',
    ];

    public function countFilteredData($searchValue = '')
    {
        $builder = $this->db->table('fcps_one_pass_applicants ap');
        $builder->select("ap.id, ap.fcps_part_one_year, ap.fcps_part_one_session, UPPER(ap.applicant_name) AS name, UPPER(ap.father_name) AS father_name, ap.pen_number,
            ap.reg_no, ap.cell, ap.email, MAX(pr.reg_no) AS latest_reg_no");
        $builder->join('speciality sp', 'ap.subject_id = sp.speciality_id', 'left');
        $builder->join('progress_reports pr', 'ap.reg_no = pr.reg_no');
        $builder->groupBy('ap.reg_no');

        // Apply search filter
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
        $builder->select("ap.id, ap.fcps_part_one_year, ap.fcps_part_one_session, UPPER(ap.applicant_name) AS name, UPPER(ap.father_name) AS father_name, ap.pen_number,
            ap.reg_no, ap.cell, ap.email, MAX(pr.reg_no) AS latest_reg_no");
        $builder->join('speciality sp', 'ap.subject_id = sp.speciality_id', 'left');
        $builder->join('progress_reports pr', 'ap.reg_no = pr.reg_no');
        $builder->groupBy('ap.reg_no');

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
        $data['totalRecords']       = $this->db->table('progress_reports')->select('reg_no')->distinct()->countAllResults();
        $data['totalSearchRecords'] = $this->countFilteredData($searchValue);
        return $data;
    }

    public function getProgressReportByRegNo($regNo)
    {
        $builder = $this->db->table('progress_reports pr');
        $builder->select('pr.*, institute.name AS training_institute_name, speciality.name AS department_name, supervisors.supervisor_name AS new_supervisor_name');
        $builder->join('institute', 'institute.institute_id  = pr.training_institute_id', 'left');
        $builder->join('speciality', 'speciality.speciality_id  = pr.department_id', 'left');
        $builder->join('supervisors', 'supervisors.id  = pr.supervisor_id', 'left');
        $builder->where('pr.reg_no', $regNo);
        $builder->where('pr.status', true);
        $builder->orderBy('pr.training_start_date', 'ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getProgressReportById($reportId)
    {
        $builder = $this->db->table('progress_reports pr');
        $builder->select('pr.*, institute.name AS training_institute_name, speciality.name AS department_name, sv.supervisor_name AS new_supervisor_name, sv.mobile,
                            sv.email, sv.mailing_address,  dg.designation AS new_designation, sp.name AS new_supervisor_subject_name');
        $builder->join('institute', 'institute.institute_id  = pr.training_institute_id', 'left');
        $builder->join('speciality', 'speciality.speciality_id  = pr.department_id', 'left');
        $builder->join('supervisors sv', 'sv.id  = pr.supervisor_id', 'left');
        $builder->join('designations dg', 'sv.designation_id  = dg.id', 'left');
        $builder->join('speciality sp', 'sv.subject_id  = sp.speciality_id', 'left');
        $builder->where('pr.id', $reportId);
        $builder->where('pr.status', true);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function approveProgressReport($reportId)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('progress_reports');
        $builder->where('id', $reportId);
        $builder->update(['training_accepted' => true, 'accepted_by' => $user->id, 'accepted_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

    public function receiveProgressReport($reportId)
    {
        $user = service('auth')->user();

        $builder = $this->db->table('progress_reports');
        $builder->where('id', $reportId);
        $builder->update(['progress_report_received' => true, 'received_by' => $user->id, 'received_date' => date('Y-m-d H:i:s')]);

        return $this->db->affectedRows();
    }

}