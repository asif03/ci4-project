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
}
