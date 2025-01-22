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
            array('db' => 'department_name', 'dt' => 0),
        );

        // Build the SQL query string from the request
        $limit = limit($request, $columns);
        $order = order($request, $columns);
        $where = filter($request, $columns, $bindings);

        // Main query to actually get the data
        /*$data = self::sql_exec($db, $bindings,
        "SELECT `" . implode("`, `", self::pluck($columns, 'db')) . "`
        FROM `$table`
        $where
        $order
        $limit"
        );*/

        echo $where;
        die();
        // Main query to actually get the data
        $sql  = "SELECT `" . implode("`, `", array_column($columns, 'db')) . "` FROM `$table` $where $order $limit";
        $data = $this->db->query($sql, [
            ':binding_0:' => $request['search']['value'],
            ':binding_1:' => $request['search']['value'],
            ':binding_2:' => $request['search']['value'],
            ':binding_3:' => $request['search']['value'],
            ':binding_4:' => $request['search']['value'],
        ])->getResultArray();

        // Data set length after filtering
        $sqlFilterLength      = "SELECT COUNT(`{$primaryKey}`) AS CNT FROM `$table` $where";
        $exeQueryFilterLength = $this->db->query($sqlFilterLength);
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
