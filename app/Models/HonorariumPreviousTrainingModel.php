<?php

namespace App\Models;

use CodeIgniter\Model;

class HonorariumPreviousTrainingModel extends Model
{
    protected $table      = 'honorarium_previous_trainings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'honorarium_id',
        'slot_sl_no',
        'training_from',
        'training_to',
        'speciality_id',
        'training_institute_id',
        'training_category_id',
        'honorarium_taken',
        'created_at',
        'updated_at',
    ];

    public function getPreviousTrainingsByApplicationId($applicationId)
    {
        $builder = $this->db->table('honorarium_information hi');
        $builder->select('hi.id, hi.applicant_id, pt.training_institute_id, ti.name AS training_institute_name, pt.speciality_id, sp.name AS department_name,
                            pt.training_from, pt.training_to, pt.training_category_id, tc.training_category_title, pt.honorarium_taken');
        $builder->join('honorarium_previous_trainings pt', 'hi.id = pt.honorarium_id', 'left');
        $builder->join('institute ti', 'pt.training_institute_id = ti.institute_id', 'left');
        $builder->join('speciality sp', 'pt.speciality_id = sp.speciality_id', 'left');
        $builder->join('training_categories tc', 'pt.training_category_id = tc.id', 'left');
        $builder->where('hi.applicant_id', $applicationId);
        $builder->orderBy('pt.slot_sl_no', 'ASC');

        return $builder->get()->getResultArray();

    }
}
