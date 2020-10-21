<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TermRelationships extends Migration
{
	public function up()
	{
		$this->forge->addField([
				'term_relationship_id' => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
					'null'           => false,
				],
				'term_id'          => [
					'type'           => 'INT',
					'null'           => false,
				],
				'post_id'          => [
					'type'           => 'INT',
					'null'           => false,
				],
				
		]);

		$this->forge->addKey('term_relationship_id', true);
		$this->forge->createTable('term_relationships');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('term_relationships');
	}
}
