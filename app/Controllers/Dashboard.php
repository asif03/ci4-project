<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;
use App\Models\InstituteModel;
use App\Models\ProgressReportModel;

class Dashboard extends BaseController
{
    protected $trainingInstituteModel;
    protected $fcpsPartOneModel;
    protected $progressReportModel;

    public function __construct()
    {
        $this->trainingInstituteModel = new InstituteModel();
        $this->progressReportModel    = new ProgressReportModel();
        $this->fcpsPartOneModel       = new FcpsPartOneModel();
    }

    public function index(): string
    {
        // Get the authenticated user
        $user = auth()->user();

        //dd($user->inGroup);
        $progressReports = $this->progressReportModel->where('reg_no', $user->username)->where('status', true)->findAll();

        $prgresScale = [
            'Poor'         => 1,
            'Average'      => 2,
            'Satisfactory' => 3,
            'Good'         => 4,
            'Excellent'    => 5,
        ];

        $percentageOfProgress = array();

        foreach ($progressReports as $key => $progressReport) {
            $score = 0;
            if (isset($prgresScale[$progressReport['attendance']])) {
                $score = $score + $prgresScale[$progressReport['attendance']];
            }

            if (isset($prgresScale[$progressReport['knowledge']])) {
                $score = $score + $prgresScale[$progressReport['knowledge']];
            }

            if (isset($prgresScale[$progressReport['skill']])) {
                $score = $score + $prgresScale[$progressReport['skill']];
            }

            if (isset($prgresScale[$progressReport['attitude']])) {
                $score = $score + $prgresScale[$progressReport['attitude']];
            }

            $percentageOfProgress[$key] = ($score / 20) * 100;
        }

        $data = [
            'title'           => 'Dashboard',
            'routeName'       => 'dashboard',
            'userInfo'        => $user,
            'progressReports' => $progressReports,
            'progressCharts'  => $percentageOfProgress,
        ];

        //dd($data);

        // Check if the user is in the 'admin' group
        if (!$user->inGroup('superadmin', 'admin')) {
            return view('trainee/trainee-dashboard', $data);
        } else {
            return view('dashboard', $data);
        }

        // The user is an admin, so load the dashboard view.
        //return view('dashboard');

    }
}
