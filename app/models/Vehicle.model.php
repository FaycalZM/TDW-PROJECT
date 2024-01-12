<?php

class VehicleModel
{
    use Model;

    protected $table = 'vehicle';

    public function getAllVehicles()
    {
        $this->order_column = 'idVehicle';
        return $this->getAll();
    }

    public function getVehicle($idVehicle)
    {
        return $this->first(['idVehicle' => $idVehicle]);
    }

    public function getVehicleInfos($idVehicle)
    {
        $this->table = 'vehicle';
        $vehicle = $this->first(['idVehicle' => $idVehicle]);
        $this->table = 'version';
        $version = $this->first(['idVersion' => $vehicle['idVersion']]);
        $this->table = 'modele';
        $modele = $this->first(['idModele' => $version['idModele']]);
        $this->table = 'marque';
        $marque = $this->first(['idMarque' => $modele['idMarque']]);
        $infos = [
            'version' => $version,
            'modele' => $modele,
            'marque' => $marque,
        ];
        return $infos;
    }
    public function addVehicle()
    {
        $data = $_POST;
        $this->insert($data);
    }
    public function editVehicle($idVehicle)
    {
        $data = $_POST;
        $this->update($idVehicle, $data, 'idVehicle');
    }
    public function deleteVehicle($idVehicle)
    {
        $this->delete($idVehicle, 'idVehicle');
    }

    public function getVehicleImages($idVehicle)
    {
        $this->table = 'imagevehicle';
        $results = $this->where(['idVehicle' => $idVehicle]);
        return $results;
    }
}
