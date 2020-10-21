<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'posts';
    protected $primaryKey = 'post_id';

    protected $returnType     = 'array';
    protected $protectFields = true;

    protected $allowedFields = [
        'post_title', 
        'post_slug', 
        'post_type',
        'post_content',
        'post_status', 
        'post_user',
        'comment_status',
        'comment_count',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';
    
    protected $skipValidation     = false;

    protected $validationRules    = [
        
        'post_title'     => 'required|min_length[4]|max_length[200]',
        'post_slug'      => 'required|is_unique[posts.post_slug]',
        'post_type'      => 'required|alpha',
        'post_content'   => 'required',
        'post_status'    => 'required|alpha',
        'post_user'      => 'required|numeric',
        'comment_status' => 'required|alpha',
        'comment_count'  => 'required|numeric',
    ];

    protected $validationMessages = [
        'post_title' => [
          'required' => 'el titulo es requerido',
          'min_length' => 'longitud minima de {field}',
          'max_length' => 'longitud maxima de {field}',
        ],
        'post_slug' => [
          'is_unique' => 'el slug ya existe'
        ],
        'post_type' => [
          'alpha' => 'caracteres invalidos'
        ],
        'post_status' => [
          'alpha' => 'caracteres invalidos'
        ],
        'post_user' => [
          'numeric' => 'user_id invalido'
        ]
    ];


}