<?php

namespace App\Validation;

use CodeIgniter\Database\ConnectionInterface;

class CustomRules
{
    public function composite_unique(string $str, string $fields, array $data): bool
    {
        if (is_null($fields) || is_null($data)) {
            // Should never happen if rule is correctly configured
            return false;
        }

        // 1. Parse the rule string: 'table.field1,field2,field3...'
        $params    = explode('.', $fields);
        $tableName = $params[0];

        $columnList = explode(',', $params[1]);

        /** @var ConnectionInterface $db */
        $db      = \Config\Database::connect();
        $builder = $db->table($tableName);

        // Add WHERE clauses for the remaining composite fields
        foreach ($columnList as $columnName) {
            // Trim whitespace and ensure the field exists in the input data
            $columnName = trim($columnName);
            if (!isset($data[$columnName])) {
                // If a required composite field is missing, validation fails (or handle as an error)
                return false;
            }
            $builder->where($columnName, $data[$columnName]);
        }

        // --- TEMPORARY DEBUGGING LINES START ---
        //$queryString = $builder->getCompiledSelect();
        //log_message('debug', 'Composite Unique Query: ' . $queryString);
        //log_message('debug', 'Counted Rows: ' . $builder->countAllResults());
        // --- TEMPORARY DEBUGGING LINES END ---

        // Execute the query
        $count = $builder->countAllResults(false);

        // If count > 0, the combination already exists, so it's NOT unique (return false)
        return $count === 0;
    }
}
