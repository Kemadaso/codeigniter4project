<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Options extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'option_id' => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'option_name'      => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'option_value'     => [
					'type'           => 'TEXT',
					'null'           => true,
				],
				
		]);

		$this->forge->addKey('option_id', true);
		$this->forge->addUniqueKey('option_name');
		$this->forge->createTable('options');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('options');
	}
}
