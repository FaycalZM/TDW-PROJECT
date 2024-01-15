<?php

class AdminModel
{
    use Model;

    protected $table;

    public function __construct($table = 'user')
    {
        $this->table = $table;
    }

    // ----------------------------------------------
    public function verify_admin_exists($idAdmin)
    {
        $result = $this->where(["idUser" => $idAdmin]);
        if (is_array($result)) {
            if (count($result) > 0) return true;
        }
        return false;
    }

    public function getAdmin()
    {
        $data = $_POST;
        $admin = $this->first($data);
        if ($admin['is_admin'] == 1)
            return $admin;
        return false;
    }

    // ----- Users management -----
    public function validate_user($idUser)
    {
        $data['is_valid'] = 1;
        $this->update($idUser, $data, 'idUser');
    }

    public function invalidate_user($idUser)
    {
        $data['is_valid'] = 0;
        $this->update($idUser, $data, 'idUser');
    }
    public function delete_user($idUser)
    {
        $this->delete($idUser, 'idUser');
    }

    // if the filter is provided
    public function get_filtered_sorted_users()
    {
        if (key_exists('filter_sort', $_POST)) {
            $query = "SELECT * FROM user ";
            $filter_provided = ($_POST["sex"] != "" || $_POST["firstName"] != "" || $_POST["lastName"] != ""  || $_POST["birthDate"] != ""  || $_POST["is_valid"] != "");
            if ($filter_provided)  $query .= "WHERE ";

            if ($_POST["sex"]) {
                $query .= " sex = :sex AND ";
            } else {
                unset($_POST["sex"]);
            }
            if ($_POST["firstName"]) {
                // put backslashes before underscores and percent signs
                $_POST['firstName'] = strtr($_POST['firstName'], array('_' => '\_', '%' => '\%'));
                $query .= " firstName LIKE :firstName AND ";
            } else {
                unset($_POST["firstName"]);
            }

            if ($_POST["lastName"]) {
                // put backslashes before underscores and percent signs
                $_POST['lastName'] = strtr($_POST['lastName'], array('_' => '\_', '%' => '\%'));
                $query .= " lastName LIKE :lastName AND ";
            } else {
                unset($_POST["lastName"]);
            }
            if ($_POST["birthDate"]) {
                $query .= " birthDate = :birthDate AND ";
            } else {
                unset($_POST["birthDate"]);
            }

            if ($_POST["is_valid"] != "") {
                $query .= " is_valid = :is_valid AND ";
            } else {
                unset($_POST["is_valid"]);
            }

            // remove the last 'AND '
            if ($filter_provided) $query = substr_replace($query, "", -4);

            if ($_POST["sortBy"] != '') {
                $query .= " ORDER BY {$_POST['sortBy']} {$_POST['sortOrder']}";
            }
            unset($_POST["sortBy"]);
            unset($_POST["sortOrder"]);
            unset($_POST['filter_sort']);

            $result = $this->query($query, $_POST);

            return $result;
        } else {
            // no filter nor sort is provided
            return $this->getAll();
        }
    }

    // ----- Vehicles management -----

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

    // ----- Feedback management -----
    // Vehicles feedback
    public function validateVehicleFeedback($idAvisVehicle)
    {
        $this->table = 'avisvehicle';
        $this->update($idAvisVehicle, ['is_valid' => 1], 'idAvisVehicle');
    }
    public function invalidateVehicleFeedback($idAvisVehicle)
    {
        $this->table = 'avisvehicle';
        $this->update($idAvisVehicle, ['is_valid' => 0], 'idAvisVehicle');
    }
    public function deleteVehicleFeedback($idAvisVehicle)
    {
        $this->table = 'avisvehicle';
        $this->delete($idAvisVehicle, 'idAvisVehicle');
    }
    // Brands feedback
    public function validateBrandFeedback($idAvisMarque)
    {
        $this->table = 'avismarque';
        $this->update($idAvisMarque, ['is_valid' => 1], 'idAvisMarque');
    }
    public function invalidateBrandFeedback($idAvisMarque)
    {
        $this->table = 'avismarque';
        $this->update($idAvisMarque, ['is_valid' => 0], 'idAvisMarque');
    }
    public function deleteBrandFeedback($idAvisMarque)
    {
        $this->table = 'avismarque';
        $this->delete($idAvisMarque, 'idAvisMarque');
    }

    // ----- Settings management -----
    // Contact infos management
    public function getAllContacts()
    {
        $this->table = 'contact';
        $this->order_column = 'idContact';
        return $this->getAll();
    }

    public function addContact()
    {
        $data = $_POST;
        $this->insert($data);
    }

    public function editContact($idContact)
    {
        $data = $_POST;
        $this->update($idContact, $data, 'idContact');
    }
    public function deleteContact($idContact)
    {
        $this->delete($idContact, 'idContact');
    }
    // Guides d'achat management
    public function getAllGuides()
    {
        $this->table = 'guidesachats';
        $this->order_column = 'idGuide';
        return $this->getAll();
    }

    public function addGuide()
    {
        $data = $_POST;
        $this->insert($data);
    }

    public function editGuide($idGuide)
    {
        $data = $_POST;
        $this->update($idGuide, $data, 'idGuide');
    }
    public function deleteGuide($idGuide)
    {
        $this->delete($idGuide, 'idGuide');
    }
    // Diaporama management
    public function getAllDiaporama()
    {
        $this->table = 'diaporama';
        $this->order_column = 'idDiaporama';
        return $this->getAll();
    }

    public function addDiaporama()
    {
        $data = $_POST;
        $this->insert($data);
    }

    public function editDiaporama($idDiaporama)
    {
        $data = $_POST;
        $this->update($idDiaporama, $data, 'idDiaporama');
    }

    public function deleteDiaporama($idDiaporama)
    {
        $this->delete($idDiaporama, 'idDiaporama');
    }
}
