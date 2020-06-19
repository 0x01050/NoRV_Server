<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Machine extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          		=> [
					'type'           => 'VARCHAR',
					'constraint'     => '16'
			],
			'master'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '128'
			],
			'slave'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '128'
			],
			'status'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '16'
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('machine');
	}

	public function down()
	{
		$this->forge->dropTable('machine');
	}
}
