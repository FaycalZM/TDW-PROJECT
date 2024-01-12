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
}
