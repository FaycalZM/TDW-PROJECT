<?php

class Home
{
    use Controller;

    public function show_homepage()
    {
        $this->getView('homepage');
        $this->getModel('home');
        $this->getModel('brand');
        $view = new HomepageView();
        $homeModel = new HomeModel();
        $brandsModel = new BrandModel();

        $diaporama = $homeModel->getDiaporama();
        $brands = $brandsModel->getAllBrands();
        for ($i = 0; $i < count($brands); $i++) {
            $brandImages = $brandsModel->getBrandImages($brands[$i]['idMarque']);
            $brands[$i]['logo'] = $brandImages[0]['imageURL'];
        }

        $view->page_head(["view.css"], "Homepage");
        $view->show_page_header();
        $view->show_diaporama($diaporama);
        $view->show_menu();
        // homepage content
        $view->show_brands_logos($brands);


        $view->show_page_footer();
        $view->page_foot("view.js");
    }
}
