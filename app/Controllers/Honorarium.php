<?php

namespace App\Controllers;

use App\Models\HonorariumInformationModel;

class Honorarium extends BaseController
{
    protected $honorariumModel;

    public function __construct()
    {
        $this->honorariumModel = new HonorariumInformationModel();
    }

    public function getIndex()
    {
        $data = [
            'title'       => 'Honorarium',
            'honorariums' => $this->honorariumModel->getHonorariums(),
        ];

        return view('Honorarium/index', $data);
    }

    public function getSearchedHonorariums()
    {
        //$_GET['search']['value'] = 'Asif';
        //$_GET['columns'][0]      = 'department_name';

        $result = $this->honorariumModel->getSearchHonorariums($_GET);

        echo json_encode($result);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Honorarium',
        ];

        return view('Honorarium/create', $data);
    }

    public function store()
    {
        $this->honorariumModel->save([
            'honorarium_name'   => $this->request->getPost('honorarium_name'),
            'honorarium_amount' => $this->request->getPost('honorarium_amount'),
            'honorarium_date'   => $this->request->getPost('honorarium_date'),
            'honorarium_status' => $this->request->getPost('honorarium_status'),
        ]);

        return redirect()->to('/honorariums');
    }

    public function edit($id)
    {
        $data = [
            'title'      => 'Edit Honorarium',
            'honorarium' => $this->model->find($id),
        ];

        return view('Honorarium/edit', $data);
    }

    public function update($id)
    {
        $this->honorariumModel->save([
            'id'                => $id,
            'honorarium_name'   => $this->request->getPost('honorarium_name'),
            'honorarium_amount' => $this->request->getPost('honorarium_amount'),
            'honorarium_date'   => $this->request->getPost('honorarium_date'),
            'honorarium_status' => $this->request->getPost('honorarium_status'),
        ]);

        return redirect()->to('/honorariums');
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->to('/honorariums');
    }
}

//431354
