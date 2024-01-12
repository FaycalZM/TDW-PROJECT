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
}
