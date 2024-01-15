<?php

class UserModel
{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = ["firstName", "lastName", "sex", "birthDate", "email", "password", "is_admin"];

    public function verify_email_exists($email)
    {
        $result = $this->where(["email" => $email]);
        if (is_array($result)) {
            if (count($result) > 0) return true;
        }
        return false;
    }

    public function insert_user()
    {
        unset($_POST['conf_pwd']);
        $this->insert($_POST);
    }
    // get user by email and password
    public function get_user()
    {
        $credentials = $_POST;
        $user = $this->first($credentials);
        return $user;
    }

    public function getUserById($idUser)
    {
        return $this->first(['idUser' => $idUser]);
    }

    // get user's favorite vehicles
    public function getUserFavoriteVehicles($idUser)
    {
        $this->table = 'favorites';
        $this->setOrderColumn('idFavorite');
        $this->setOrderType('ASC');
        return $this->where(['idUser' => $idUser]);
    }
    // get all user's vehicles rating
    public function getUserVehiclesRating($idUser)
    {
        $this->table = 'notevehicle';
        $this->setOrderColumn('idNoteVehicle');
        $this->setOrderType('ASC');
        return $this->where(['idUser' => $idUser]);
    }
    // get all user's brands rating
    public function getUserBrandsRating($idUser)
    {
        $this->table = 'notemarque';
        $this->setOrderColumn('idNoteMarque');
        $this->setOrderType('ASC');
        return $this->where(['idUser' => $idUser]);
    }
    // get all user's vehicles feedback
    public function getUserVehiclesFeedback($idUser)
    {
        $this->table = 'avisvehicle';
        $this->setOrderColumn('idAvisVehicle');
        $this->setOrderType('ASC');
        return $this->where(['idUser' => $idUser, 'is_valid' => 1]);
    }
    // get all user's brands feedback
    public function getUserBrandsFeedback($idUser)
    {
        $this->table = 'avismarque';
        $this->setOrderColumn('idAvisMarque');
        $this->setOrderType('ASC');
        return $this->where(['idUser' => $idUser, 'is_valid' => 1]);
    }

    // users favorites management
    public function checkFavoriteExists($idUser, $idVehicle)
    {
        $this->table = 'favorites';
        $result = $this->first(['idUser' => $idUser, 'idVehicle' => $idVehicle]);
        if ($result) return true;
        return false;
    }

    public function addFavoriteVehicle($idUser, $idVehicle)
    {
        $this->table = 'favorites';
        $this->insert(['idUser' => $idUser, 'idVehicle' => $idVehicle]);
    }
    public function deleteFavoriteVehicle($idUser, $idVehicle)
    {
        $this->table = 'favorites';
        $this->deleteWhere(['idUser' => $idUser, 'idVehicle' => $idVehicle]);
    }
}
