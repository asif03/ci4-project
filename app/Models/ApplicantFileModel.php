<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicantFileModel extends Model
{
    protected $table      = 'applicant_files';
    protected $primaryKey = 'fiile_id';

    protected $allowedFields = ['applicant_id', 'file_name', 'type', 'status', 'created', 'modified'];

}
