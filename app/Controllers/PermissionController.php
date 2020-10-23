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
			$res = $this->permission->find($param);
		} else {
			#nickname
			$res = $this->permission->where('name', $param)->first();
		}

		if($res) {
			return $this->respond($res);
		} else {
			return $this->respond((object)[]);
		}

	}

	public function create()
	{
    
    
    $config_roles = config('Config\\Pager');
    
    $data = [
      "name"  => $this->request->getPost('name'),
      "roles" => $this->request->getPost('narolesme'),
    ];

    foreach($data['roles'] as $k => $rol) {
      if(array_key_exists($rol, $config_roles->roles)) {
        //throw new \Exception('valor no encontrado');
      }
    }

    $data['roles'] = json_encode($data['roles']);

		if($id = $this->permission->insert($data)) {
      $rol = $this->permission->find($id);

      //$toarray = (array) json_decode($rol['roles'], true);
      $rol['roles'] = (array) json_decode($rol['roles'], true);
      /*
      if($toarray == null) {
        $rol['roles'] = [];
      }*/
      
      return $this->respond($rol, 200);
      
		} else {
			return $this->respond($this->permission->errors(), 200);
		}
			
	}

	public function update($id)
	{
		
		$field = getBody();
		
    if($rol = $this->permission->find($id)) {

      //$toarray = (array) json_decode($rol['roles'], true);
      $rol['roles'] = (array) json_decode($rol['roles'], true);
      /*
      if($toarray == null) {
        $rol['roles'] = [];
      }*/

      if($rol['name'] == @$field['name']) {
        unset($field['name']);
      }

      if($rol['roles'] == @$field['roles']) {
        unset($field['roles']);
      }
      
      if(empty($field)) {
				return $this->respond($rol, 200);
			}
			
			
			if($id = $this->permission->update($id, $field)) {
        
        $rol = $this->permission->find($id);
        
        //$toarray = (array) json_decode($rol['roles'], true);
        $rol['roles'] = (array) json_decode($rol['roles'], true);
        /*
        if($toarray == null) {
          $rol['roles'] = [];
        }*/

        return $this->respond($rol, 200);
        
      } else {
        return $this->respond($this->permission->errors(), 200);
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
