<?php namespace App\Controllers;

class Status extends BaseController
{
	public function search()
	{
        $data = $this->request->getPost();

        $statusModel = new \App\Models\StatusModel();
        echo json_encode($statusModel->search($data));
	}
    
	public function getById($machineID)
	{
        $statusModel = new \App\Models\StatusModel();
        echo json_encode($statusModel->getById($machineID));
    }
    
	public function getOBSActivity($machineID)
	{
        $statusModel = new \App\Models\StatusModel();
        echo $statusModel->getOBSActivity($machineID);
    }

    public function reportMaster()
    {
        $data = $this->request->getPost();

        $machineModel = new \App\Models\MachineModel();
        $machine = $machineModel->where('master', $data['id'])->first();

        if($machine == null)
            return;
        
        $data['id'] = $machine->id;
        
        $status = new \App\Entities\Status();
        $status->fill($data);
        $status->master_update = date('Y-m-d H:i:s');
        
        $statusModel = new \App\Models\StatusModel();
        $statusModel->report($status);
    }

    public function reportSlave()
    {
        $data = $this->request->getPost();

        $machineModel = new \App\Models\MachineModel();
        $machine = $machineModel->where('slave', $data['id'])->first();

        if($machine == null)
            return;
        
        $data['id'] = $machine->id;
        
        $status = new \App\Entities\Status();
        $status->id = $data['id'];
        $status->slave_update = date('Y-m-d H:i:s');
        
        $statusModel = new \App\Models\StatusModel();
        $statusModel->report($status);
    }

    public function reportOBS()
    {
        $data = $this->request->getPost();
        
        $status = new \App\Entities\Status();
        $status->id = $data['id'];
        $status->obs_update = date('Y-m-d H:i:s');
        
        $statusModel = new \App\Models\StatusModel();
        $statusModel->report($status);
    }
}
