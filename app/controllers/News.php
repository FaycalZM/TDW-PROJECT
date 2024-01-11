<?php

class News
{
    use Controller;

    public function show_news()
    {
        $this->getView('news');
        $this->getModel("home");

        echo "This is the news page";
    }
}
