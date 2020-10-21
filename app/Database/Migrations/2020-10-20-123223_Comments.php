<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comments extends Migration
{
	public function up()
	{
		
		$this->forge->addField([
				'comment_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'comment_post_id'       => [
					'type'           => 'INT',
					'unsigned'       => true,
					'null'           => false,
				],
				'comment_user_email' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => true,
				],
				'comment_user_ip' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => true,
				],
				'comment_content' => [
					'type'           => 'TEXT',
					'null'           => true,
				],
				'comment_approved' => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',
					'null'           => false,
				],
				'comment_agent' => [
					'type'           => 'VARCHAR',
					'constraint'     => '300',
					'null'           => true,
				],
				'comment_status' => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',
					'null'           => false,
				],
				'comment_parent' => [
					'type'           => 'INT',
					'null'           => true,
				],
				'comment_user' => [
					'type'           => 'INT',
					'unsigned'       => true,
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

		$this->forge->addKey('comment_id', true);
		$this->forge->createTable('comments');


	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('comments');
	}
}
