<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'post_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'post_title'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '200',
					'null'           => false,
				],
				'post_slug' => [
					'type'           => 'VARCHAR',
					'constraint'     => '200',
					'null'           => false,
				],
				'post_type' => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',
					'null'           => false,
				],
				'post_content' => [
					'type'           => 'TEXT',
					'null'           => true,
				],
				'post_status' => [
					'type'           => 'TEXT',
					'constraint'     => '20',
					'null'           => false,
				],
				'post_user' => [
					'type'           => 'INT',
					'unsigned'       => true,
					'null'           => false,
				],
				'comment_status' => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',
					'null'           => false,
				],
				'comment_count' => [
					'type'           => 'INT',
					'null'           => true,
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

		$this->forge->addKey('post_id', true);
		$this->forge->addUniqueKey('post_slug');
		$this->forge->createTable('posts');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('posts');
	}
}
