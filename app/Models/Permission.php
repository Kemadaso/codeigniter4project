<?php namespace App\Models;

use CodeIgniter\Model;

class Term extends Model
{
    protected $table      = 'permissions';
    protected $primaryKey = 'permission_id';

    protected $returnType     = 'array';
    protected $protectFields = true;

    protected $allowedFields = [
        'name', 
        'roles', 
    ];

    protected $skipValidation     = false;

    protected $validationRules    = [
        'name'    => 'required|alpha_space|min_length[2]|max_length[50]|is_unique[permissions.name]',
        'roles'   => 'required|valid_json',
    ];

    protected $validationMessages = [];


}