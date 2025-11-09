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
}