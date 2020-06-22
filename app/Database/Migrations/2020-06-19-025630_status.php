<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Status extends Migration{
    public function up(){
        $this->forge->addField([
            'id'          		=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128'
            ],
            'master_update'       => [
                    'type'           => 'DATETIME'
            ],
            'usage'          	=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '512'
            ],
            'obs'          	    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '512'
            ],
            'button'          	=> [
                    'type'           => 'VARCHAR',
                    'constraint'     => '512'
            ],
            'depo'         	    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '512'
            ],
            'jobs'         	    => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '512'
            ],
            'witness'          	=> [
                    'type'           => 'TEXT'
            ],
            'screenshot'       	=> [
                    'type'           => 'TEXT'
            ],
            'slave_update'       => [
                    'type'           => 'DATETIME'
            ],
            'obs_update'         => [
                    'type'           => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('status');
    }

    public function down(){
        $this->forge->dropTable('status');
    }
}