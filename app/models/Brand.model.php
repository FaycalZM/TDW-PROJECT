<?php

class BrandModel
{
    use Model;

    protected $table = 'marque';

    public function getAllBrands()
    {
        $this->order_column = 'idMarque';
        return $this->getAll();
    }
    public function getBrand($idMarque)
    {
        return $this->first(['idMarque' => $idMarque]);
    }
    public function addBrand()
    {
        $data = $_POST;
        $this->insert($data);
    }
    public function editBrand($idMarque)
    {
        $data = $_POST;
        $this->update($idMarque, $data, 'idMarque');
    }
    public function deleteBrand($idMarque)
    {
        $this->delete($idMarque, 'idMarque');
    }

    public function getBrandImages($idMarque)
    {
        $this->table = 'imagemarque';
        $results = $this->where(['idMarque' => $idMarque]);
        return $results;
    }

    public function getAllBrandsImages()
    {
        $this->table = 'imagemarque';
        $results = $this->getAll();
        return $results;
    }

    public function getBrandNote($idMarque)
    {
        $this->table = "marque";
        $brand = $this->getBrand($idMarque);
        return $brand['note'];
    }

    public function rateBrand($idMarque, $idUser)
    {
        $this->table = 'notemarque';
        $brandNote = floatval($this->getBrandNote($idMarque));
        if ($brandNote) {
            // the brand is rated
            $brandNotes = $this->where(['idMarque' => $idMarque]);
            $notesNum = count($brandNotes);
            $userNote = floatval($_POST['note_value']);
            $newNote = ($brandNote * $notesNum + $userNote) / ($notesNum + 1);
        } else {
            // the brand is not rated
            $userNote = floatval($_POST['note_value']);
            $newNote = $userNote;
        }
        $this->table = 'notemarque';
        $this->insert(['idUser' => $idUser, 'idMarque' => $idMarque, 'note_value' => $userNote]);
        $this->table = 'marque';
        $this->update($idMarque, ['note' => $newNote], 'idMarque');
    }

    public function getBrandMostAppreciatedFeedback($idMarque)
    {
        $this->table = 'avismarque';
        $brandFeedback = $this->where(['idMarque' => $idMarque, 'is_valid' => 1]);
        usort($brandFeedback, function ($feedback1, $feedback2) {
            return $feedback2['appreciation'] <=> $feedback1['appreciation'];
        });
        return array_slice($brandFeedback, 0, 3);
    }

    public function getAllBrandFeedback($idMarque)
    {
        $this->table = 'avismarque';
        $brandFeedback = $this->where(['idMarque' => $idMarque]);
        return $brandFeedback;
    }

    public function getAllValidBrandFeedback($idMarque)
    {
        $this->table = 'avismarque';
        $brandFeedback = $this->where(['idMarque' => $idMarque, 'is_valid' => 1]);
        return $brandFeedback;
    }

    public function feedbackBrand($idMarque, $idUser)
    {
        $this->table = 'avismarque';
        $userComment = $_POST['avis_text'];
        $this->insert(['idUser' => $idUser, 'idMarque' => $idMarque, 'avis_text' => $userComment]);
    }

    public function likeBrandComment($idAvisMarque)
    {
        $this->table = 'avismarque';
        $comment = $this->first(['idAvisMarque' => $idAvisMarque]);
        $likes = $comment['appreciation'];
        $this->update($idAvisMarque, ['appreciation' => $likes + 1], 'idAvisMarque');
    }
}
