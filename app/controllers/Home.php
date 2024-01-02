<?php

class Home
{
    use Controller;

    public function index($a = '', $b = '', $c = '')
    {
        show($a);

        echo 'This is from the index method';
        $this->view('home');
    }
    public function add($a = '', $b = '', $c = '')
    {
        show($a);

        echo 'This is from the Add method';
        $this->view('home');
    }
}
