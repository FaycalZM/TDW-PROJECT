<?php

class Admin
{
    use Controller;

    public function verify_admin_login()
    {
        $this->getModel("admin");
        $model = new AdminModel('user');
        if (!isset($_SESSION["idAdmin"])) {
            $message = encode_message("you have to login first");
            redirect("/login_admin/show_login_admin&message=" . $message);
        } else {
            if (!$model->verify_admin_exists($_SESSION["idAdmin"])) {
                $message = encode_message("you have to login first");
                redirect("/login_admin/show_login_admin&message=" . $message);
            }
        }
    }

    public function show_admin_page()
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();

        $view->page_head(["admin_page.css"], "Admin page");
        $view->show_admin_page();
        $view->page_foot('');
    }
    // users management actions
    public function show_users_management()
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel('user');
        $model->setOrderColumn('idUser');
        $users = $model->get_filtered_sorted_users();
        $view->page_head(["users_management.css", "menu.css"], 'Users management');
        $view->show_menu();
        $view->show_users_management($users);
        $view->page_foot('');
    }

    public function validate_user($userId)
    {
        $this->verify_admin_login();
        $userId = intval($userId);
        $this->getModel('admin');
        $admin = new AdminModel('user');
        $admin->validate_user($userId);
        redirect("/admin/show_users_management");
    }

    public function invalidate_user($userId)
    {
        $this->verify_admin_login();
        $userId = intval($userId);
        $this->getModel('admin');
        $admin = new AdminModel('user');
        $admin->invalidate_user($userId);
        redirect("/admin/show_users_management");
    }

    public function delete_user($userId)
    {
        $this->verify_admin_login();
        $userId = intval($userId);
        $this->getModel('admin');
        $admin = new AdminModel('user');
        $admin->delete_user($userId);
        redirect("/admin/show_users_management");
    }

    // news management actions
    public function show_news_management()
    {
        $this->verify_admin_login();

        $this->getView('news');
        $view = new NewsView();

        $this->getModel('news');
        $model = new NewsModel();

        $news = $model->getAllNews();
        for ($i = 0; $i < count($news); $i++) {
            $images = $model->getNewsImages($news[$i]['idNews']);
            $news[$i]['images'] = $images;
        }

        $view->page_head(["news_management.css", "menu.css"], 'News management');
        $view->show_menu();
        $view->show_news_management($news);
        $view->page_foot('');
    }

    public function add_news_page()
    {
        $this->verify_admin_login();

        $this->getView('news');
        $view = new NewsView();

        $view->page_head(["news_management.css", "menu.css"], 'Add News');
        $view->show_menu();
        $view->add_news_form();
        $view->page_foot('');
    }

    public function add_news()
    {
        $this->getModel('news');
        $model = new NewsModel();
        $model->addNews();
        redirect('/admin/show_news_management');
    }

    public function edit_news_page($idNews)
    {
        $this->verify_admin_login();

        $this->getView('news');
        $view = new NewsView();
        $this->getModel('news');
        $model = new NewsModel();

        $news = $model->first(['idNews' => $idNews]);

        $view->page_head(["news_management.css", "menu.css"], 'Edit News');
        $view->show_menu();
        $view->edit_news_form($news);
        $view->page_foot('');
    }

    public function edit_news($idNews)
    {
        $this->getModel('news');
        $model = new NewsModel();
        $model->editNews($idNews);
        redirect('/admin/show_news_management');
    }
    public function delete_news($idNews)
    {
        $this->getModel('news');
        $model = new NewsModel();
        $model->deleteNews($idNews);
        redirect('/admin/show_news_management');
    }

    public function add_news_image_page($idNews)
    {
        $this->verify_admin_login();

        $this->getView('news');
        $view = new NewsView();

        $view->page_head(["news_management.css", "menu.css"], 'Add News image');
        $view->show_menu();
        $view->add_news_image_form($idNews);
        $view->page_foot('');
    }

    public function add_news_image($idNews)
    {
        $this->getModel('news');
        $model = new NewsModel();
        $model->addNewsImage($idNews);
        redirect('/admin/show_news_management');
    }
    public function delete_news_image($idImageNews)
    {
        $this->getModel('news');
        $model = new NewsModel();
        $model->deleteNewsImage($idImageNews);
        redirect('/admin/show_news_management');
    }

    // vehicles management actions
    public function show_vehicles_management()
    {
        $this->verify_admin_login();

        $this->getView('vehicle');
        $view = new VehicleView();

        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $this->getModel('brand');
        $brandModel = new BrandModel();

        $brands = $brandModel->getAllBrands();
        $vehicles = $vehicleModel->getAllVehicles();
        for ($i = 0; $i < count($vehicles); $i++) {
            $vehicleInfos = $vehicleModel->getVehicleInfos($vehicles[$i]['idVehicle']);
            $vehicles[$i]['version'] = $vehicleInfos['version'];
            $vehicles[$i]['modele'] = $vehicleInfos['modele'];
            $vehicles[$i]['marque'] = $vehicleInfos['marque'];
        }

        $view->page_head(["vehicles_management.css", "menu.css"], 'Vehicles management');
        $view->show_menu();
        $view->show_vehicles_management($vehicles, $brands);
        $view->page_foot('');
    }


    public function add_vehicle_page()
    {
        $this->verify_admin_login();

        $this->getView('vehicle');
        $view = new VehicleView();

        $view->page_head(["vehicles_management.css", "menu.css"], 'Add Vehicle');
        $view->show_menu();
        $view->add_vehicle_form();
        $view->page_foot('');
    }

    public function add_vehicle()
    {
        $this->verify_admin_login();
        $this->getModel('vehicle');
        $model = new VehicleModel();
        $model->addVehicle();
        redirect('/admin/show_vehicles_management');
    }

    public function edit_vehicle_page($idVehicle)
    {
        $this->verify_admin_login();

        $this->getView('vehicle');
        $view = new VehicleView();
        $this->getModel('vehicle');
        $model = new VehicleModel();
        $vehicle = $model->first(['idVehicle' => $idVehicle]);
        $view->page_head(["vehicles_management.css", "menu.css"], 'Edit Vehicle');
        $view->show_menu();
        $view->edit_vehicle_form($vehicle);
        $view->page_foot('');
    }

    public function edit_vehicle($idVehicle)
    {
        $this->verify_admin_login();
        $this->getModel('vehicle');
        $model = new VehicleModel();
        $model->editVehicle($idVehicle);
        redirect('/admin/show_vehicles_management');
    }
    public function delete_vehicle($idVehicle)
    {
        $this->verify_admin_login();
        $this->getModel('vehicle');
        $model = new VehicleModel();
        $model->deleteVehicle($idVehicle);
        redirect('/admin/show_vehicles_management');
    }

    public function add_brand_page()
    {
        $this->verify_admin_login();

        $this->getView('brand');
        $view = new BrandView();

        $view->page_head(["vehicles_management.css", "menu.css"], 'Add brand');
        $view->show_menu();
        $view->add_brand_form();
        $view->page_foot('');
    }

    public function add_brand()
    {
        $this->verify_admin_login();
        $this->getModel('brand');
        $model = new BrandModel();
        $model->addBrand();
        redirect('/admin/show_vehicles_management');
    }

    public function edit_brand_page($idMarque)
    {
        $this->verify_admin_login();

        $this->getView('brand');
        $view = new BrandView();
        $this->getModel('brand');
        $model = new BrandModel();
        $brand = $model->first(['idMarque' => $idMarque]);
        $view->page_head(["vehicles_management.css", "menu.css"], 'Edit Brand');
        $view->show_menu();
        $view->edit_brand_form($brand);
        $view->page_foot('');
    }

    public function edit_brand($idMarque)
    {
        $this->verify_admin_login();
        $this->getModel('brand');
        $model = new BrandModel();
        $model->editBrand($idMarque);
        redirect('/admin/show_vehicles_management');
    }
    public function delete_brand($idMarque)
    {
        $this->verify_admin_login();
        $this->getModel('brand');
        $model = new BrandModel();
        $model->deleteBrand($idMarque);
        redirect('/admin/show_vehicles_management');
    }

    public function show_vehicle_details($idVehicle)
    {
        $this->verify_admin_login();

        $this->getView('vehicle');
        $view = new VehicleView();
        $this->getModel('vehicle');
        $model = new VehicleModel();
        $vehicle = $model->getVehicle($idVehicle);
        $images = $model->getVehicleImages($idVehicle);

        $view->page_head(["vehicles_management.css", "menu.css", "vehicle_details.css"], 'Vehicles management');
        $view->show_menu();
        $view->vehicle_details_page($vehicle, $images);
        $view->page_foot('');
    }
    public function show_brand_details($idMarque)
    {
        $this->verify_admin_login();

        $this->getView('brand');
        $view = new BrandView();
        $this->getModel('brand');
        $model = new BrandModel();
        $brand = $model->getBrand($idMarque);
        $images = $model->getBrandImages($idMarque);

        $view->page_head(["vehicles_management.css", "menu.css", "vehicle_details.css"], 'Vehicles management');
        $view->show_menu();

        $view->brand_details_page($brand, $images);
        $view->page_foot('');
    }



    // feedback management actions
    public function show_feedback_management()
    {
        echo "this is the feedback management page";
    }
    // website settings management
    public function show_settings()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $view->page_head(["admin_page.css", 'menu.css'], "Settings page");
        $view->show_menu();
        $view->show_settings_page();
        $view->page_foot('');
    }
    // contact management
    public function show_contact_management()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $this->getModel('admin');
        $model = new AdminModel();

        $contacts = $model->getAllContacts();

        $view->page_head(["admin_page.css", "menu.css"], 'Contact management');
        $view->show_menu();
        $view->show_contact_management($contacts);
        $view->page_foot('');
    }

    public function add_contact_page()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $view->page_head(["admin_page.css", "menu.css"], 'Add contact');
        $view->show_menu();
        $view->add_contact_form();
        $view->page_foot('');
    }

    public function add_contact()
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('contact');
        $model->addContact();
        redirect('/admin/show_contact_management');
    }

    public function edit_contact_page($idContact)
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();
        $this->getModel('admin');
        $model = new AdminModel('contact');
        $contact = $model->first(['idContact' => $idContact]);
        $view->page_head(["admin_page.css", "menu.css"], 'Edit contact');
        $view->show_menu();
        $view->edit_contact_form($contact);
        $view->page_foot('');
    }
    public function edit_contact($idContact)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('contact');
        $model->editContact($idContact);
        redirect('/admin/show_contact_management');
    }

    public function delete_contact($idContact)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('contact');
        $model->deleteContact($idContact);
        redirect('/admin/show_contact_management');
    }
    // guides management 
    public function show_guides_management()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $this->getModel('admin');
        $model = new AdminModel();

        $guides = $model->getAllGuides();

        $view->page_head(["admin_page.css", "menu.css"], 'Guides management');
        $view->show_menu();
        $view->show_guides_management($guides);
        $view->page_foot('');
    }

    public function add_guide_page()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $view->page_head(["admin_page.css", "menu.css"], 'Add guide');
        $view->show_menu();
        $view->add_guide_form();
        $view->page_foot('');
    }

    public function add_guide()
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('guidesachats');
        $model->addGuide();
        redirect('/admin/show_guides_management');
    }

    public function edit_guide_page($idGuide)
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();
        $this->getModel('admin');
        $model = new AdminModel('guidesachats');
        $guide = $model->first(['idGuide' => $idGuide]);
        $view->page_head(["admin_page.css", "menu.css"], 'Edit guide');
        $view->show_menu();
        $view->edit_guide_form($guide);
        $view->page_foot('');
    }
    public function edit_guide($idGuide)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('guidesachats');
        $model->editGuide($idGuide);
        redirect('/admin/show_guides_management');
    }

    public function delete_guide($idGuide)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('guidesachats');
        $model->deleteGuide($idGuide);
        redirect('/admin/show_guides_management');
    }
    // Diaporama management
    // guides management 
    public function show_diaporama_management()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $this->getModel('admin');
        $model = new AdminModel();

        $diaporama = $model->getAllDiaporama();

        $view->page_head(["admin_page.css", "menu.css"], 'Diaporama management');
        $view->show_menu();
        $view->show_diaporama_management($diaporama);
        $view->page_foot('');
    }

    public function add_diaporama_page()
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();

        $view->page_head(["admin_page.css", "menu.css"], 'Add diaporama');
        $view->show_menu();
        $view->add_diaporama_form();
        $view->page_foot('');
    }

    public function add_diaporama()
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('diaporama');
        $model->addDiaporama();
        redirect('/admin/show_diaporama_management');
    }

    public function edit_diaporama_page($idDiaporama)
    {
        $this->verify_admin_login();

        $this->getView('settings');
        $view = new SettingsView();
        $this->getModel('admin');
        $model = new AdminModel('diaporama');
        $diaporama = $model->first(['idDiaporama' => $idDiaporama]);
        $view->page_head(["admin_page.css", "menu.css"], 'Edit diaporama');
        $view->show_menu();
        $view->edit_diaporama_form($diaporama);
        $view->page_foot('');
    }
    public function edit_diaporama($idDiaporama)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('diaporama');
        $model->editDiaporama($idDiaporama);
        redirect('/admin/show_diaporama_management');
    }

    public function delete_diaporama($idDiaporama)
    {
        $this->verify_admin_login();
        $this->getModel('admin');
        $model = new AdminModel('diaporama');
        $model->deleteDiaporama($idDiaporama);
        redirect('/admin/show_diaporama_management');
    }
}
