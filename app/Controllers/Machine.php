<?php namespace App\Controllers;

class Machine extends BaseController
{
	public function create()
	{
        $data = $this->request->getPost();

        $machine = new \App\Entities\Machine();
        $machine->fill($data);

        $machineModel = new \App\Models\MachineModel();
        $machineModel->insert($machine);

        echo 'Successfully Added';
	}

	public function update($machineID)
	{
        $data = $this->request->getPost();
        $data['id'] = $machineID;

        $machine = new \App\Entities\Machine();
        $machine->fill($data);

        $machineModel = new \App\Models\MachineModel();
        $machineModel->save($machine);

        echo 'Successfully Updated';
    }
    
	public function getMachine($type, $deviceID)
	{
        $machineModel = new \App\Models\MachineModel();
        echo $machineModel->getMachine($type, $deviceID);
    }
}
