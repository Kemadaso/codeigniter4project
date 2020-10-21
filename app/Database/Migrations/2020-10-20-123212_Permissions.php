<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permissions extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'permission_id'    => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'name'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'null'           => false,
				],
				'roles' => [
					'type'           => 'TEXT',
					'null'           => true,
				],
		]);

		$this->forge->addKey('permission_id', true);
		$this->forge->addUniqueKey('name');
		$this->forge->createTable('permissions');
		
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('permissions');
	}
}
