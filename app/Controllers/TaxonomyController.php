<?php 

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class TaxonomyController extends BaseController
{
	
	use ResponseTrait;

	function __construct() {
		// call Grandpa's constructor
		//parent::__construct();
		helper('utils');
		$this->taxonomy = model('App\Models\Taxonomy');

	}
	
	public function all()
	{
    $db  = db_connect();
    
		if($res = $this->taxonomy->findAll()) {
			return $this->respond($res);
		} else {
			return $this->respond([]);
		}

	}

	public function show($param)
	{
		
		if(is_numeric($param)) {
			#taxonomy_id
			$res = $this->taxonomy->find($param);
		} else {
			#taxonomy_name
			$res = $this->taxonomy->where('taxonomy_name', $param)->first();
		}

		if($res) {
			return $this->respond($res);
		} else {
			return $this->respond((object)[]);
		}

	}

	public function create()
	{
		
		$field = $this->request->getPost();
		//$pass_has = do_password($field['password']);
		$data = [
			'taxonomy_name'         => @$field['taxonomy_name'],
			'taxonomy_description'  => @$field['taxonomy_description'],
		
		];
		
		if($id = $this->taxonomy->insert($data)) {
			return $this->respond($this->taxonomy->find($id), 200);
		} else {
			return $this->respond($this->taxonomy->errors(), 200);
		}

	}

	public function update($id)
	{
		
		$field = getBody();
		
    if($tax = $this->taxonomy->find($id)) {

      if($tax['taxonomy_name'] == @$field['taxonomy_name']) {
        unset($field['taxonomy_name']);
      }

      if($tax['taxonomy_description'] == @$field['taxonomy_description']) {
        unset($field['taxonomy_description']);
      }
      
      if(empty($field)) {
				return $this->respond($tax, 200);
			}

			if($this->taxonomy->update($tax['taxonomy_id'], $field)) {
				return $this->respond($this->taxonomy->find($tax['taxonomy_id']), 200);
			} else {
				return $this->respond($this->taxonomy->errors(), 200);
			}
      
    } else {
      return $this->respond(['error' => 'id no exists'], 200);
    }


	}

	public function delete($id)
	{
		
		if($id = $this->taxonomy->find($id)) {
			return $this->respond(['success' => true], 200);
		} else {
			return $this->respond(['success' => false], 200);
    }
    
	}


}
