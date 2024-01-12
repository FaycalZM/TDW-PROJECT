<?php

class NewsModel
{
    use Model;

    protected $table = 'news';


    public function getAllNews()
    {
        $this->order_column = 'idNews';
        return $this->getAll();
    }

    public function addNews()
    {
        $data = $_POST;
        $this->insert($data);
    }
    public function editNews($idNews)
    {
        $data = $_POST;
        $this->update($idNews, $data, 'idNews');
    }
    public function deleteNews($idNews)
    {
        $this->delete($idNews, 'idNews');
    }


    public function addNewsImage($idNews)
    {
        $this->table = 'imagenews';
        $data = $_POST;
        $data['idNews'] = $idNews;
        $this->insert($data);
    }
    public function deleteNewsImage($idImageNews)
    {
        $this->table = 'imagenews';
        $this->delete($idImageNews, 'idImageNews');
    }

    public function getNewsImages($idNews)
    {
        $this->table = 'imageNews';
        $results = $this->where(['idNews' => $idNews]);
        return $results;
    }
}
