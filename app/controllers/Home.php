<?php

class Home
{
    use Controller;

    public function index($data = [])
    {
        $this->getView("homepage");
        $view = new HomepageView();
        $view->page_head("user.css", "Login");
        $view->show_menu();
        $view->show_login_page();
        $view->show_page_footer();
        $view->page_foot("");
    }
    public function add($data = [])
    {
        echo 'This is from the Add method';
        $this->getView('homepage');
        $homepage_view = new HomepageView();
        $homepage_view->show_filter();
    }
}
