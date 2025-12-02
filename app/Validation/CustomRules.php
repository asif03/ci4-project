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

        // The first column in $columnList is the name of the column that $str belongs to.
        $firstColumn = array_shift($columnList);

        /** @var ConnectionInterface $db */
        $db      = \Config\Database::connect();
        $builder = $db->table($tableName);

        // Start the query with the value of the field currently being validated ($str)
        $builder->where($firstColumn, $str);

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

        // Execute the query
        $count = $builder->countAllResults();

        // If count > 0, the combination already exists, so it's NOT unique (return false)
        return $count === 0;
    }
}
