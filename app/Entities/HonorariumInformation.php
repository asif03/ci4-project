<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class HonorariumInformation extends Entity
{
    protected $attributes = [
        'id'                        => null,
        'applicant_id'              => null,
        'bmdc_reg_no'               => null,
        'training_institute_id'     => null,
        'department_name'           => null,
        'honorarium_slot_id'        => null,
        'honorarium_year'           => null,
        'previous_training_inmonth' => null,
        'honorarium_position'       => null,
        'eligible_status'           => null,
        'bill_sl_no'                => null,
        'eligiblity_date'           => null,
        'eligible_by'               => null,
        'payment_status'            => null,
        'payment_date'              => null,
        'payment_amount'            => null,
        'payment_by'                => null,
        'status'                    => null,
        'remarks'                   => null,
        'created_at'                => null,
        'updated_at'                => null,
    ];

    protected $dataMap = [
        'applicantId'             => 'applicant_id',
        'bmdcRegNo'               => 'bmdc_reg_no',
        'trainingInstituteId'     => 'training_institute_id',
        'departmentName'          => 'department_name',
        'honorariumSlotId'        => 'honorarium_slot_id',
        'honorariumYear'          => 'honorarium_year',
        'previousTrainingInmonth' => 'previous_training_inmonth',
        'honorariumPosition'      => 'honorarium_position',
        'eligibleStatus'          => 'eligible_status',
        'billSlNo'                => 'bill_sl_no',
        'eligiblityDate'          => 'eligiblity_date',
        'eligibleBy'              => 'eligible_by',
        'paymentStatus'           => 'payment_status',
        'paymentDate'             => 'payment_date',
        'paymentAmount'           => 'payment_amount',
        'paymentBy'               => 'payment_by',
    ];

}
