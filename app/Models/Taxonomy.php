<?php namespace App\Models;

use CodeIgniter\Model;

class Taxonomy extends Model
{
    protected $table      = 'taxonomys';
    protected $primaryKey = 'taxonomy_id';

    protected $returnType     = 'array';
    protected $protectFields = true;

    protected $allowedFields = [
      'taxonomy_name', 
      'taxonomy_description', 
    ];

    //protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;

    //protected $posibility_status = 'active,disabled';

    protected $validationRules    = [
        'taxonomy_name'        => 'required|is_unique[taxonomys.taxonomy_name]',
        'taxonomy_description' => 'max_length[300]|string',
    ];

    protected $validationMessages = [];


}