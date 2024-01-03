<?php

class Home
{
    use Controller;

    public function show_homepage()
    {
        $this->getView('homepage');
        $this->getModel("home");

        $view = new HomepageView();
        $model = new HomeModel();
        $view->page_head(["view.css"], "Homepage");
        // $diaporama = $model->getDiaporama();
        $view->show_page_header();
        $slides = ["audi.png", "mercedes.png", "toyota.png", "bmw.png"];
        $view->show_diaporama($slides);
        $view->show_menu();
        $view->show_page_footer();
        $view->page_foot("view.js");
    }
}
