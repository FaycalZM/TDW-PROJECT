<?php

class News
{
    use Controller;

    public function show_news_page()
    {
        $this->getView('homepage');
        $this->getModel('home');
        $this->getModel(('news'));
        $view = new HomepageView();
        $newsModel = new NewsModel();

        $allNews = $newsModel->getAllNews();
        for ($i = 0; $i < count($allNews); $i++) {
            $image = $newsModel->getNewsImage($allNews[$i]['idNews']);
            $allNews[$i]['image'] = $image ?? "news/default_news.jpg";
        }



        $view->page_head(["view.css", "news_page.css"], "News page");
        $view->show_page_header();
        $view->show_menu();

        $view->news_page($allNews);

        $view->show_page_footer();
        $view->page_foot("");
    }
    public function show_news_details($idNews)
    {
        $this->getView('homepage');
        $this->getModel('home');
        $this->getModel(('news'));
        $view = new HomepageView();
        $newsModel = new NewsModel();

        $news = $newsModel->getNewsById($idNews);
        $images = $newsModel->getNewsImages($idNews);
        $news['images'] = $images;



        $view->page_head(["view.css", "news_page.css"], "News page");
        $view->show_page_header();
        $view->show_menu();

        $view->news_details_page($news);

        $view->show_page_footer();
        $view->page_foot("");
    }
}
