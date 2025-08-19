<?php

namespace App\Controllers;

class TrainingController extends BaseController
{
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

        return view('Training/index', $data);

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

        return view('Training/basic-info', $data);

    }

    public function progressReports()
    {
        // Check if the authenticated user has the 'posts.edit' permission
        if (!auth()->user()->can('training.basic.get')) {
            // User does not have permission, so deny access.
            //return redirect()->back()->with('error', 'You are not authorized to edit posts.');

            $data['name'] = 'You are not authorized to edit posts.';
        } else {
            $data['name'] = 'Asif';
        }

        return view('Training/trainings', $data);

    }
}
