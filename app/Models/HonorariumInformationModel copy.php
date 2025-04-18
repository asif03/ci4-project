<?php

namespace App\Models;

use CodeIgniter\Model;

class HonorariumInformationModel extends Model
{

    protected $table              = 'honorarium_information';
    protected $primaryKey         = 'id';
    protected $allowedFields      = ['honorarium_id', 'honorarium_name', 'honorarium_amount', 'honorarium_date', 'honorarium_status'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $returnType         = \App\Entities\HonorariumInformation::class;
    protected $useSoftDeletes     = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $helper;

    public function __construct()
    {
        parent::__construct();
        helper('datatable');
    }

    /**
     * @param false|string $status
     *
     * @return array|null
     */
    public function getHonorariums($status = true)
    {
        if ($status === true) {

            $result = $this->findAll();
            return $result;
        }

        return $this->where(['status' => $status])->first();
    }

    /**
     * @param string $search
     *
     * @return array|null
     */
    public function getSearchHonorariums($request)
    {
        $primaryKey = 'id';
        $table      = 'honorarium_information';
        $bindings   = array();

        // Allow for a JSON string to be passed in
        if (isset($request['json'])) {
            $request = json_decode($request['json'], true);
        }

        $columns = array(
            //array('db' => 'honorarium_year', 'dt' => 0),
            array('db' => 'department_name', 'dt' => 0),
            array('db' => 'honorarium_year', 'dt' => 1),
        );

        //$join = 'JOIN honorarium_slot ON honorarium_information.honorarium_slot_id = honorarium_slot.id';

        // Build the SQL query string from the request
        $limit = limit($request, $columns);
        $order = order($request, $columns);
        $where = filter($request, $columns, $bindings);

        $likeWhat = array();

        for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            //$requestColumn = $request['columns'][$i];
            //for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            //if ($requestColumn['searchable'] == 'true' && $requestColumn['search']['value'] != '') {
            $likeWhat[$i] = "%" . $request['search']['value'] . "%";
            //}

        }

        // Main query to actually get the data
        //$sql = "SELECT `" . implode("`, `", array_column($columns, 'db')) . "` FROM `$table` $where $order $limit";
        /*$data = $this->db->query($sql, [
        '%' . $request['search']['value'] . '%',
        ])->getResultArray();*/

        $sql = "SELECT `" . implode("`, `", array_column($columns, 'db')) . "` FROM `$table` $where $order $limit";
        //$sql = "SELECT `" . implode("`, `", array_column($columns, 'db')) . "` FROM `$table`  $where $order $limit";

        $data = $this->db->query($sql, $likeWhat)->getResultArray();

        // Data set length after filtering
        $sqlFilterLength      = "SELECT COUNT(`{$primaryKey}`) AS CNT FROM `$table` $where";
        $exeQueryFilterLength = $this->db->query($sqlFilterLength, $likeWhat);
        $rowFilterLength      = $exeQueryFilterLength->getRow();

        if (isset($rowFilterLength)) {
            $recordsFiltered = $rowFilterLength->CNT;
        } else {
            $recordsFiltered = 0;
        }

        // Total data set length
        $sqlTotalLength      = "SELECT COUNT(`{$primaryKey}`) AS CNT FROM `$table`";
        $exeQueryTotalLength = $this->db->query($sqlTotalLength);
        $rowTotalLength      = $exeQueryTotalLength->getRow();

        if (isset($rowTotalLength)) {
            $recordsTotal = $rowTotalLength->CNT;
        } else {
            $recordsTotal = 0;
        }

        /*
         * Output
         */
        return array(
            "draw"            => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => data_output($columns, $data),
        );

    }
}
