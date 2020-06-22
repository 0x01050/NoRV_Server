<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Info extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          		=> [
					'type'           => 'INT',
					'auto_increment' => true
			],
			'key'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '128'
			],
			'value'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '128'
			],
			'status'          	=> [
					'type'           => 'VARCHAR',
					'constraint'     => '16'
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('info');
	}

	public function down()
	{
		$this->forge->dropTable('info');
	}
}
