<?php namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
    protected $table          = 'info';
    protected $primaryKey     = 'id';
    protected $returnType     = 'App\Entities\Info';
    protected $allowedFields  = ['id', 'key', 'value', 'status'];

}