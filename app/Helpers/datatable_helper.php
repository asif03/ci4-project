<?php

use CodeIgniter\CodeIgniter;

/**
 * Paging
 *
 * Construct the LIMIT clause for server-side processing SQL query
 *
 *  @param  array $request Data sent to server by DataTables
 *  @param  array $columns Column information array
 *  @return string SQL limit clause
 */
function limit($request, $columns)
{
    $limit = '';

    if (isset($request['start']) && $request['length'] != -1) {
        $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
    }

    return $limit;
}

/**
 * Ordering
 *
 * Construct the ORDER BY clause for server-side processing SQL query
 *
 *  @param  array $request Data sent to server by DataTables
 *  @param  array $columns Column information array
 *  @return string SQL order by clause
 */
function order($request, $columns)
{
    $order = '';

    if (isset($request['order']) && count($request['order'])) {
        $orderBy   = array();
        $dtColumns = array_column($columns, 'dt');

        for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
            $columnIdx     = $request['order'][$i]['column'];
            $requestColumn = $request['columns'][$columnIdx];
            $column        = $columns[$columnIdx];

            if ($requestColumn['orderable'] == 'true') {
                $dir = $request['order'][$i]['dir'] === 'asc' ?
                'ASC' :
                'DESC';

                $orderBy[] = '`' . $column['db'] . '` ' . $dir;
            }
        }

        if (count($orderBy)) {
            $order = 'ORDER BY ' . implode(', ', $orderBy);
        }
    }

    return $order;
}

/**
 * Searching / Filtering
 *
 * Construct the WHERE clause for server-side processing SQL query.
 *
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here performance on large
 * databases would be very poor
 *
 *  @param  array $request Data sent to server by DataTables
 *  @param  array $columns Column information array
 *  @param  array $bindings Array of values for PDO bindings, used in the
 *    sql_exec() function
 *  @return string SQL where clause
 */
function filter($request, $columns, &$bindings)
{
    $globalSearch = array();
    $columnSearch = array();
    $dtColumns    = array_column($columns, 'dt');

    if (isset($request['search']) && $request['search']['value'] != '') {
        $str = $request['search']['value'];

        for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            $requestColumn = $request['columns'][$i];
            $columnIdx     = array_search($requestColumn['data'], $dtColumns);
            $column        = $columns[$columnIdx];

            if ($requestColumn['searchable'] == 'true') {
                if (!empty($column['db'])) {
                    $binding        = bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                    $globalSearch[] = "`" . $column['db'] . "` LIKE " . $binding;
                }
            }
        }
    }

    // Individual column filtering
    if (isset($request['columns'])) {
        for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
            $requestColumn = $request['columns'][$i];
            $columnIdx     = array_search($requestColumn['data'], $dtColumns);
            $column        = $columns[$columnIdx];

            $str = $requestColumn['search']['value'];

            if ($requestColumn['searchable'] == 'true' &&
                $str != '') {
                if (!empty($column['db'])) {
                    $binding        = bind($bindings, '%' . $str . '%', PDO::PARAM_STR);
                    $columnSearch[] = "`" . $column['db'] . "` LIKE " . $binding;
                }
            }
        }
    }

    // Combine the filters into a single string
    $where = '';

    if (count($globalSearch)) {
        $where = '(' . implode(' OR ', $globalSearch) . ')';
    }

    if (count($columnSearch)) {
        $where = $where === '' ?
        implode(' AND ', $columnSearch) :
        $where . ' AND ' . implode(' AND ', $columnSearch);
    }

    if ($where !== '') {
        $where = 'WHERE ' . $where;
    }

    return $where;
}

/**
 * Create a PDO binding key which can be used for escaping variables safely
 * when executing a query with sql_exec()
 *
 * @param  array &$a    Array of bindings
 * @param  mixed  $val  Value to bind
 * @param  int    $type PDO field type
 * @return string       Bound key to be used in the SQL where this parameter
 *   would be used.
 */
if (!function_exists('bind')) {
    function bind(&$a, $val, $type)
    {
        //$key = ':binding_' . count($a) . ':';
        //$key = '?' . count($a);
        $key = '?';

        $a[] = array(
            'key'  => $key,
            'val'  => $val,
            'type' => $type,
        );

        return $key;
    }
}

/**
 * Create the data output array for the DataTables rows
 *
 *  @param  array $columns Column information array
 *  @param  array $data    Data from the SQL get
 *  @return array          Formatted data in a row based format
 */
function data_output($columns, $data)
{
    $out = array();

    for ($i = 0, $ien = count($data); $i < $ien; $i++) {
        $row = array();

        for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
            $column = $columns[$j];

            // Is there a formatter?
            if (isset($column['formatter'])) {
                if (empty($column['db'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i]);
                } else {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['db']], $data[$i]);
                }
            } else {
                if (!empty($column['db'])) {
                    $row[$column['dt']] = $data[$i][$columns[$j]['db']];
                } else {
                    $row[$column['dt']] = "";
                }
            }
        }

        $out[] = $row;
    }

    return $out;
}
