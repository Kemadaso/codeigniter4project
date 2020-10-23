<?php namespace App\Models;

use CodeIgniter\Model;

class Term extends Model
{
    protected $table      = 'terms';
    protected $primaryKey = 'term_id';

    protected $returnType     = 'array';
    protected $protectFields = true;

    protected $allowedFields = [
        'taxonomy', 
        'term_name', 
        'term_slug',
        'term_parent',
        'term_order', 
        'term_status',
    ];

    //protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;

    //protected $posibility_status = 'active,disabled';

    protected $validationRules    = [
        'taxonomy'    => 'required|exists_value[taxonomys.taxonomy_name]',
        'term_name'   => 'required|min_length[2]|max_length[50]|alpha_numeric_space',
        'term_slug'   => 'required|max_length[50]|is_unique[terms.term_slug]',
        'term_parent' => 'exists_value[terms.term_id]',
        'term_order'  => 'numeric',
        'term_status' => 'alpha|in_list[active,disabled]',
    ];

    protected $validationMessages = [];


}