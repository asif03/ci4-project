<?php

namespace App\Controllers;

use App\Models\FcpsPartOneModel;

class TrainingController extends BaseController
{
    /**
     * FCPS Part-I Passed Student List
     */
    public function index()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.list')) {
            // User does not have permission, so deny access.
            return redirect()->to('/401')->with('error', 'You are not authorized to access this page !');
        }

        $data = [
            'title'     => 'FCPS Part-I',
            'pageTitle' => 'FCPS Part-I Passed Candidates',
            //'statistics' => $statisticsData,
        ];

        return view('Partone/index', $data);
    }
}
