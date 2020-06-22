<?php namespace App\Controllers;

class Info extends BaseController
{
	public function update()
	{
        $updates = $this->request->getPost();

        $infoModel = new \App\Models\InfoModel();
        foreach($updates as $key => $value)
        {
            $info = $infoModel->where('key', $key)
                              ->first();
            if($info == null)
            {
                $info = new \App\Entities\Info();
                $info->key = $key;
            }
            $info->value = $value;
            $infoModel->save($info);
        }
	}
    
	public function retrieve()
	{
        $result = (object) array();
        $infoModel = new \App\Models\InfoModel();
        $infos = $infoModel->findAll();
        foreach($infos as $info)
        {
            $result->{$info->key} = $info->value;
        }
        echo json_encode($result);
    }
}
