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
        $this->table = 'vehicle';
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

    public function getVehicleImage($idVehicle)
    {
        $this->table = 'imagevehicle';
        $results = $this->first(['idVehicle' => $idVehicle]);
        return $results;
    }

    public function getVehicleNote($idVehicle)
    {
        $this->table = "vehicle";
        $vehicle = $this->getVehicle($idVehicle);
        return $vehicle['note'];
    }

    public function rateVehicle($idVehicle, $idUser)
    {
        $this->table = 'notevehicle';
        $vehicleNote = floatval($this->getVehicleNote($idVehicle));
        if ($vehicleNote) {
            // the vehicle is rated
            $vehicleNotes = $this->where(['idVehicle' => $idVehicle]);
            $notesNum = count($vehicleNotes);
            $userNote = floatval($_POST['note_value']);
            $newNote = ($vehicleNote * $notesNum + $userNote) / ($notesNum + 1);
        } else {
            // the vehicle is not rated
            $userNote = floatval($_POST['note_value']);
            $newNote = $userNote;
        }
        $this->table = 'notevehicle';
        $this->insert(['idUser' => $idUser, 'idVehicle' => $idVehicle, 'note_value' => $userNote]);
        $this->table = 'vehicle';
        $this->update($idVehicle, ['note' => $newNote], 'idVehicle');
    }

    public function getVehicleMostAppreciatedFeedback($idVehicle)
    {
        $this->table = 'avisvehicle';
        $vehicleFeedback = $this->where(['idVehicle' => $idVehicle, 'is_valid' => 1]);
        usort($vehicleFeedback, function ($feedback1, $feedback2) {
            return $feedback2['appreciation'] <=> $feedback1['appreciation'];
        });
        return array_slice($vehicleFeedback, 0, 3);
    }

    public function getAllVehicleFeedback($idVehicle)
    {
        $this->table = 'avisvehicle';
        $vehicleFeedback = $this->where(['idVehicle' => $idVehicle]);
        return $vehicleFeedback;
    }
    public function getAllValidVehicleFeedback($idVehicle)
    {
        $this->table = 'avisvehicle';
        $vehicleFeedback = $this->where(['idVehicle' => $idVehicle, 'is_valid' => 1]);
        return $vehicleFeedback;
    }

    public function getAllVehiclesFeedback()
    {
        $this->table = 'avisvehicle';
        $this->order_column = 'is_valid';
        return $this->getAll();
    }

    public function feedbackVehicle($idVehicle, $idUser)
    {
        $this->table = 'avisvehicle';
        $userComment = $_POST['avis_text'];
        $this->insert(['idUser' => $idUser, 'idVehicle' => $idVehicle, 'avis_text' => $userComment]);
    }

    public function likeVehicleComment($idAvisVehicle)
    {
        $this->table = 'avisvehicle';
        $comment = $this->first(['idAvisVehicle' => $idAvisVehicle]);
        $likes = $comment['appreciation'];
        $this->update($idAvisVehicle, ['appreciation' => $likes + 1], 'idAvisVehicle');
    }
}
