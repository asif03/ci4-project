<?php

namespace App\Controllers;

use App\Models\InstituteModel;
use App\Models\SpecialityModel;

class TraineeController extends BaseController
{
    protected $trainingInstituteModel;
    protected $specialityModel;

    public function __construct()
    {
        $this->trainingInstituteModel = new InstituteModel();
        $this->specialityModel        = new SpecialityModel();
    }

    public function trainees()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/index', $data);

    }

    public function traineeBasicInfo()
    {

        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/basic-info', $data);

    }

    public function createProgressReport()
    {
        helper('form');

        $trainingInstitutes         = $this->trainingInstituteModel->where('status', true)->findAll();
        $data['trainingInstitutes'] = $trainingInstitutes;

        $departments         = $this->specialityModel->where('status', true)->findAll();
        $data['departments'] = $departments;

        //dd($departments);

        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Trainee/trainings', $data);

    }

    public function storeProgressReport()
    {
        helper('form');

        $data = $this->request->getPost(['instituteName', 'departmentName']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'instituteName'  => 'required',
            'departmentName' => 'required',
        ])) {
            // The validation fails, so returns the form.
            return $this->createProgressReport();
        }

        dd($data);

        //return redirect()->back();
    }
}
