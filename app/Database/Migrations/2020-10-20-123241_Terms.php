<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Terms extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'term_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'taxonomy'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'term_name' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => true,
				],
				'term_slug' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'term_parent' => [
					'type'           => 'INT',
					'null'           => true,
				],
				'term_order' => [
					'type'           => 'INT',
					'null'           => true,
					'default'        => 0,
				],
				'term_status' => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				
		]);

		$this->forge->addKey('term_id', true);
		$this->forge->createTable('terms');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('terms');
	}
}
