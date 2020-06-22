<?php namespace App\Models;

use CodeIgniter\Model;

class MachineModel extends Model
{
    protected $table          = 'machine';
    protected $primaryKey     = 'id';
    protected $returnType     = 'App\Entities\Machine';
    protected $allowedFields  = ['id', 'master', 'slave', 'status'];

    public function getMachine($type, $deviceID)
    {
        $machines = $this->where($type, $deviceID)
                         ->findAll();
        foreach($machines as $machine)
        {
            return array(
                'status' => 'ok',
                'id' => $machine->id
            );
        }
        return (object)array();
    }
}