<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    protected $protectFields = true;

    protected $allowedFields = [
        'nickname', 
        'email', 
        'email_token',
        'is_active',
        'password', 
        'roles',
        'group_permission',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    
    
    protected $skipValidation     = false;

    protected $validationRules    = [
        
        'email'            => 'required|valid_email|is_unique[users.email]',
        'nickname'         => 'required|min_length[6]|is_unique[users.nickname]',
        'password'         => 'required|min_length[6]',
        'repassword'       => 'required|matches[password]',
        'group_permission' => 'required|min_length[4]',
    ];
    protected $validationMessages = [
        'nickname' => [
            'required' => 'este campo es requerido',
            'min_length' => 'falta longitud',
        ],
        'email' => [
            'valid_email' => 'ingresa un email valido'
        ],
        'password' => [
            'min_length' => 'longitud minima requerida es {field}'
        ],
        'repassword' => [
            'matches' => 'las contraseñas no coinciden'
        ],
        'group_permission' => [
            'min_length' => 'longitud del grupo de permisio invalido'
        ]
    ];


}