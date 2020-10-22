<?php 

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class TermController extends BaseController
{
	
	use ResponseTrait;

	function __construct() {
		// call Grandpa's constructor
		//parent::__construct();
		helper('utils');
		$this->term = model('App\Models\Term');

	}
	
	public function all()
	{
    $db  = db_connect();
    
    $field = $this->request->getGet();

		try {
			$res = $db->query($sql)->getResult('array');
			return $this->respond($res);
		} catch (\Exception $e) {
			return $this->respond([]);
		}

	}

	public function show($param)
	{
		//var_dump(is_numeric($param));
		
		if(is_numeric($param)) {
			#user_id
			$res = $this->user->find($param);
		} elseif (is_email($param)) {
			#email
			$res = $this->user->where('email', $param)->first();
		} else {
			#nickname
			$res = $this->user->where('nickname', $param)->first();
		}

		if($res) {
			return $this->respond($res);
		} else {
			return $this->respond((object)[]);
		}

	}

	public function create()
	{
		
		$field = $this->request->getPost('taxonomy');
		//$pass_has = do_password($field['password']);

		//die(var_dump($field));

		$data = [
			'taxonomy'    => $this->request->getPost('taxonomy'),
			'term_name'   => $this->request->getPost('term_name'),
			'term_slug'   => $this->request->getPost('term_slug'),
			'term_parent' => $this->request->getPost('term_parent'),
			'term_order'  => $this->request->getPost('term_order'),
			'term_status' => $this->request->getPost('term_status'),       
		];

		//die(var_dump($data));
		
		//$this->user->insert($data);
		//return $this->respond($data, 200);

		//$data['password'] = do_password($data['password']);
		//unset($data['repassword']);

		if($id = $this->term->insert($data)) {
			return $this->respond($this->term->find($id), 200);
		} else {
			return $this->respond($this->term->errors(), 200);
		}
			


	}

	public function update($id)
	{
		
		$field = $this->request->getPost();
		
		if(isset($field['nickname'])) $data['nickname'] = $field['nickname'];
		if(isset($field['is_active'])) 	$data['is_active'] = $field['is_active'];
		if(isset($field['email'])) $data['email'] = $field['email'];
		if(isset($field['email_token'])) $data['email_token'] = $field['email_token'];
		if(isset($field['roles'])) $data['roles'] = do_json($field['roles']);
		if(isset($field['group_permission'])) $data['group_permission'] = $field['group_permission'];

		if(isset($field['password'])) {
			$data['password']   = do_password($field['password']);
			$data['repassword'] = do_password($field['repassword']);
		}

		if($id = $this->user->update($field['user_id'], $data)) {
			return $this->respond($this->user->find($id), 200);
		} else {
			return $this->respond($this->user->errors(), 200);
		}

	}

	public function delete($id)
	{
		return view('welcome_message');
	}


}
