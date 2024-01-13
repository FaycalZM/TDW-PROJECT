<?php

class HomeModel
{
    use Model;

    protected $table = '';

    public function getDiaporama()
    {
        $this->table = 'diaporama';
        $this->order_column = 'idDiaporama';
        return $this->getAll();
    }

    public function getBrandModels($idMarque)
    {
        $this->table = 'modele';
        $this->order_column = 'idModele';
        return $this->where(['idMarque' => $idMarque]);
    }
    public function getModelVersions($idModel)
    {
        $this->table = 'version';
        $this->order_column = 'idVersion';
        return $this->where(['idModele' => $idModel]);
    }
    public function getVersionVehicles($idVersion)
    {
        $this->table = 'vehicle';
        $this->order_column = 'idVehicle';
        return $this->where(['idVersion' => $idVersion]);
    }
    public function getBrandVehicles($idMarque)
    {
        $vehicles = [];
        $models = $this->getBrandModels($idMarque);
        foreach ($models as $model) {
            $versions = $this->getModelVersions($model['idModele']);
            foreach ($versions as $version) {
                $versionVehicles = $this->getVersionVehicles($version['idVersion']);
                $vehicles = array_merge($vehicles, $versionVehicles);
            }
        }
        return $vehicles;
    }
}
