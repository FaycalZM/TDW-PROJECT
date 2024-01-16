<?php

class Contact
{
    use Controller;

    public function show_contact_page()
    {
        $this->getView('contact');
        $this->getModel('admin');

        $view = new ContactView();
        $model = new AdminModel();

        $contacts = $model->getAllContacts();

        $view->page_head(["view.css", "contact_page.css"], "Contact page");
        $view->show_page_header();
        $view->show_menu();

        $view->contact_page($contacts);

        $view->show_page_footer();
        $view->page_foot("");
    }
}
