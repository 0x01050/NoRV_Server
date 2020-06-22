<?php namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table          = 'status';
    protected $primaryKey     = 'id';
    protected $returnType     = 'App\Entities\Machine';
    protected $allowedFields  = [
        'id', 'master_update', 'usage', 'obs', 'button', 'depo', 
        'jobs', 'witness', 'screenshot', 'slave_update', 'obs_update'
    ];

    private function formatter($machine)
    {
        if($machine == null)
        {
            $machine = [
                'master' => 'Master Offline',
                'usage' => '',
                'obs' => '',
                'button' => '',
                'depo' => '',
                'jobs' => '',
                'witness' => '',
                'screenshot' => '',
                'slave' => 'Slave Offline',
                'slave_obs' => ''
            ];
            return $machine;
        }

        $machine->master = 'Master Online';
        $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($machine->master_update);
        if($diff > 60)
        {
            $machine->master = 'Master Offline';
            $machine->usage = '';
            $machine->obs = '';
            $machine->button = '';
            $machine->depo = '';
            $machine->jobs = '';
            $machine->start = '';
            $machine->end = '';
            $machine->screenshot = '';
        }
        
        $machine->slave = 'Slave Online';
        $machine->slave_obs = 'Recording';
        $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($machine->slave_update);
        if($diff > 60)
        {
            $machine->slave = 'Slave Offline';
            $machine->slave_obs = '';
        }

        return $machine;
    }

    public function search($filter)
    {
        $machines = $this->where($filter)->findAll();
        foreach($machines as $machine)
        {
            $machine = $this->formatter($machine);
        }
        return $machines;
    }

    public function getById($machineID)
    {
        $machine = $this->find($machineID);
        $machine = $this->formatter($machine);
        return $machine;
    }

    public function getOBSActivity($machineID)
    {
        $machine = $this->find($machineID);
        if($machine != null)
        {
            $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($machine->obs_update);
            if($diff <= 5)
                return 'activity';
        }
        return '';
    }

    public function report($status)
    {
        $found = $this->find($status->id);
        if($found == null)
            $this->insert($status);
        else
            $this->save($status);
    }
}