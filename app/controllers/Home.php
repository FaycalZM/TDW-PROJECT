<?php

class Home extends Controller
{
    public function index()
    {
        $model = new Model();
        $new_values = ["firstName" => "Fayssal", "sex" => 'M', "birthDate" => "2002-03-25"];
        $data = ['idUser' => 1];
        // $model->update($new_values, $data);
        echo 'This is the Home controller';
        $this->view('home');
    }
}
