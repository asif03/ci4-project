<?php

namespace App\Models;

use CodeIgniter\Model;

class SupervisorModel extends Model
{
    protected $table         = 'supervisors';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'supervisor_name',
        'institute_id',
        'department_id',
        'designation_id',
        'subject_id',
        'mobile',
        'email',
        'mailing_address',
        'status',
        'created_by',
        'updated_by',
    ];
}
