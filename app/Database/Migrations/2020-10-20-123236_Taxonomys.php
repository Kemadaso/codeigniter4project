<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Taxonomys extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'taxonomy_id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'taxonomy_name'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'taxonomy_description' => [
					'type'           => 'VARCHAR',
					'constraint'     => '300',
					'null'           => true,
				],
				
		]);

		$this->forge->addKey('taxonomy_id', true);
		$this->forge->addUniqueKey('taxonomy_name');
		$this->forge->createTable('taxonomys');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('taxonomys');
	}
}
