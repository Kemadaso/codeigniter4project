<?php 

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class PermissionController extends BaseController
{
	
	use ResponseTrait;

	function __construct() {
		// call Grandpa's constructor
		//parent::__construct();
		helper('utils');
		$this->permission = model('App\Models\Permission');

	}
	
	public function index()
	{
    $db  = db_connect();
    
		if($res = $this->permission->findAll()) {
			return $this->respond($res);
		} else {
			return $this->respond([]);
		}

	}

	public function show($param)
	{
		//var_dump(is_numeric($param));
		
		if(is_numeric($param)) {
			#user_id
			$res = $this->term->find($param);
		} else {
			#nickname
			$res = $this->term->where('term_slug', $param)->first();
		}

		if($res) {
			return $this->respond($res);
		} else {
			return $this->respond((object)[]);
		}

	}

	public function create()
	{
		
		$field = $this->request->getPost('term_parent');
		//$pass_has = do_password($field['password']);

		//die(var_dump($field));

		$data = [
			'taxonomy'    => $this->request->getPost('taxonomy'),
			'term_name'   => $this->request->getPost('term_name'),
			'term_slug'   => $this->request->getPost('term_slug'),
			//'term_parent' => $this->request->getPost('term_parent'),
			'term_order'  => $this->request->getPost('term_order'),
			'term_status' => $this->request->getPost('term_status'),
		];

		if(!empty($this->request->getPost('term_parent'))) {
			$data['term_parent'] = $this->request->getPost('term_parent');
		}


		if($id = $this->term->insert($data)) {
			return $this->respond($this->term->find($id), 200);
		} else {
			return $this->respond($this->term->errors(), 200);
		}
			


	}

	public function update($id)
	{
		
		$field = getBody();
		
    if($term = $this->term->find($id)) {

      if($term['term_name'] == @$field['term_name']) {
        unset($field['term_name']);
      }

      if($term['term_slug'] == @$field['term_slug']) {
        unset($field['term_slug']);
			}
			
			if($term['term_parent'] == @$field['term_parent']) {
        unset($field['term_parent']);
			}
			
			if($term['term_order'] == @$field['term_order']) {
        unset($field['term_order']);
			}
			
			if($term['term_status'] == @$field['term_status']) {
        unset($field['term_status']);
      }
			
      if(empty($field)) {
				return $this->respond($term, 200);
			}

			if($this->term->update($id, $field)) {
				return $this->respond($this->term->find($id), 200);
			} else {
				return $this->respond($this->term->errors(), 200);
			}
      
    } else {
      return $this->respond(['error' => 'id no exists'], 200);
    }


	}

	public function delete($id)
	{
		
		if($this->term->find($id)) {
			$delete = $this->term->delete($id);
			return $this->respond(['success' => true, 'action' => $delete], 200);
		} else {
			return $this->respond(['success' => false], 200);
    }
    
	}


}
