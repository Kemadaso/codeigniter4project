<?php

namespace App\Libraries;

use Config\Database;

class MyValidation
{
  
  public function exists_value(string $str = null, string $field, array $data): bool
	{
    //var_dump($str);
    //var_dump($field);
		//var_dump($data);

		if(empty($str)) {
			return true;
		}
		
		list($table, $column) =  explode('.', $field);

		//var_dump($table,  $column);
    
		$db = Database::connect($data['DBGroup'] ?? null);

		$row = $db->table($table)
				  ->select('1')
				  ->where($column, $str)
					->limit(1);
					
		//var_dump($row->get()->getRow());

		return (bool) ($row->get()->getRow() != null);

	}
}

