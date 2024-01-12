<?php

class Home
{
    use Controller;

    public function show_homepage()
    {
        $this->getView('homepage');
        $this->getModel("home");
        $view = new HomepageView();
        $homeModel = new HomeModel();

        $diaporama = $homeModel->getDiaporama();

        $view->page_head(["view.css"], "Homepage");
        $view->show_page_header();
        $view->show_diaporama($diaporama);
        $view->show_menu();
        $view->show_page_footer();
        $view->page_foot("view.js");
    }
}
