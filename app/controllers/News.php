<?php

class News
{
    use Controller;

    public function afficher_news()
    {
        $this->getView('homepage');
        $this->getModel("home");

        echo "This is the news page";
    }
}
