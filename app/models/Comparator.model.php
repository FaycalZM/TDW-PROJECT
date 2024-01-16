<?php

class ComparatorModel
{
    use Model;

    protected $table = '';

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

    public function checkIfComparisonExists($idVehicle1, $idVehicle2)
    {
        $this->table = 'comparaison';
        $this->order_column = 'idComparaison';
        $result = $this->first(['idVehicle1' => $idVehicle1, 'idVehicle2' => $idVehicle2]);
        return $result;
    }



    public function insertComparison($idVehicle1, $idVehicle2)
    {
        // check if comparison already exists
        $comparison = $this->checkIfComparisonExists($idVehicle1, $idVehicle2);
        if (!$comparison) {
            // comparison doesn't exist --> insert comparison
            $this->insert(['idVehicle1' => $idVehicle1, 'idVehicle2' => $idVehicle2, 'popularity' => 1]);
        } else {
            // comparison exists --> update popularity
            $popularity = intval($comparison['popularity']);
            $this->updateWhere(['idVehicle1' => $idVehicle1, 'idVehicle2' => $idVehicle2], ['popularity' => $popularity + 1]);
        }
    }

    public function getMostPopularComparisons()
    {
        $this->table = 'comparaison';
        $this->order_column = 'popularity';
        $this->order_type = 'DESC';
        $this->limit = 3;

        return $this->getAll();
    }
}
