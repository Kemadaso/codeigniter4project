<?php 

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class PostController extends BaseController
{
	
	use ResponseTrait;

	function __construct() {
		// call Grandpa's constructor
		//parent::__construct();
		helper('utils');
		$this->post = model('App\Models\Post');

	}
	
	public function all()
	{
		$db  = db_connect();

		$field = $this->request->getGet();

		//var_dump($field['where']);
		$where   = (string) @$field['where'];
		$order   = (string) @$field['order'];
		$orderby = (string) @$field['orderby'];
		$limit   = (int) @$field['limit'];
		$offset  = (int) @$field['offset'];
		
		$select = [
			'post_id',
			'post_title',
			'post_slug',
			'post_type',
			'post_content',
			'post_status',
			'post_user',
			'comment_status',
			'comment_count',
			'created_at',
			'updated_at',
		];

		
		$sql = " SELECT ".join(',', $select)." FROM users ";

		//var_dump(parse_querywhere($where));
		
		# WHERE
		if($where) {
			$sql .= " WHERE " . parse_querywhere($where). " ";
		}

		# ORDER BY
		if(in_array($orderby, $select)) {
			$order = strtoupper($order);
			$order = in_array($order, ['DESC', 'ASC']) ? $order : 'DESC';

			$sql .= " ORDER BY {$orderby} {$order} ";
		}

		# LIMIT

		if((int) $offset >= 0 && (int) $limit > 0) {
			$offset = ($limit * $offset) - $limit;
			$sql .= " LIMIT {$limit}  OFFSET {$offset} ";
		}

		# RESULTS
		//$res = $db->query($sql)->getResult('array');

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
		
		$field = $this->request->getPost();
		//$pass_has = do_password($field['password']);
		$data = [
			'nickname'         => $field['nickname'],
			'is_active'        => 1,
			'email'            => $field['email'],
			'email_token'      => do_password($field['email']),
			'password'         => do_password($field['password']),
			'repassword'       => do_password($field['repassword']),       
			'roles'            => do_json($field),
			'group_permission' => 'admin',
		];
		
		//$this->user->insert($data);
		//return $this->respond($data, 200);

		//$data['password'] = do_password($data['password']);
		//unset($data['repassword']);
		if($id = $this->user->insert($data)) {
			return $this->respond($this->user->find($id), 200);
		} else {
			return $this->respond($this->user->errors(), 200);
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
