<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Links extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'link_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'link_post_id'       => [
					'type'           => 'INT',
					'unsigned'       => true,
					'null'           => false,
				],
				'link_user_id'       => [
					'type'           => 'INT',
					'unsigned'       => true,
					'null'           => true,
				],
				'link_content' => [
					'type'           => 'TEXT',
					'null'           => true,
				],
				'link_type' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'link_status' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'link_view' => [
					'type'           => 'INT',
					'null'           => true,
				],
				'link_order' => [
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

		$this->forge->addKey('link_id', true);
		$this->forge->createTable('links');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('links');
	}
}
