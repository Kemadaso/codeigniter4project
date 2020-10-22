<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

//comment
class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'user_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'nickname'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',
				],
				'is_active' => [
					'type'           => 'INT',
					'null'           => false,
				],
				'email' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'email_token' => [
					'type'           => 'VARCHAR',
					'constraint'     => '200',
					'null'           => true,
				],
				'password' => [
					'type'           => 'VARCHAR',
					'constraint'     => '200',
					'null'           => false,
				],
				'roles' => [
					'type'           => 'TEXT',
					'null'           => true,
				],
				'group_permission' => [
					'type'           => 'VARCHAR',
					'constraint'     => '200',
					'null'           => false,
				],
				'created_at' => [
					'type'           => 'DATETIME',
					'null'           => true,
				],
				'updated_at' => [
					'type'           => 'DATETIME',
					'null'           => true,
				],
		]);

		$this->forge->addKey('user_id', true);
		$this->forge->addUniqueKey('nickname');
		$this->forge->addUniqueKey('email');
		$this->forge->createTable('users');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
		//$this->forge->dropTable('users');
	}
}
