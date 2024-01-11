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
        echo "this is the news management page";
    }
    // vehicles management actions
    public function show_vehicles_management()
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel();
        $brands = $model->getAllBrands();
        $vehicles = $model->getAllVehicles();
        for ($i = 0; $i < count($vehicles); $i++) {
            $vehicleInfos = $model->getVehicleInfos($vehicles[$i]['idVehicle']);
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

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel();

        $view->page_head(["vehicles_management.css", "menu.css"], 'Add Vehicle');
        $view->show_menu();
        $view->add_vehicle_form();
        $view->page_foot('');
    }

    public function add_vehicle()
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->addVehicle();
        redirect('/admin/show_vehicles_management');
    }

    public function edit_vehicle_page($idVehicle)
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel('vehicle');
        $vehicle = $model->first(['idVehicle' => $idVehicle]);
        $view->page_head(["vehicles_management.css", "menu.css"], 'Edit Vehicle');
        $view->show_menu();
        $view->edit_vehicle_form($vehicle);
        $view->page_foot('');
    }

    public function edit_vehicle($idVehicle)
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->editVehicle($idVehicle);
        redirect('/admin/show_vehicles_management');
    }
    public function delete_vehicle($idVehicle)
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->deleteVehicle($idVehicle);
        redirect('/admin/show_vehicles_management');
    }

    public function add_brand_page()
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel();

        $view->page_head(["vehicles_management.css", "menu.css"], 'Add brand');
        $view->show_menu();
        $view->add_brand_form();
        $view->page_foot('');
    }

    public function add_brand()
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->addBrand();
        redirect('/admin/show_vehicles_management');
    }

    public function edit_brand_page($idMarque)
    {
        $this->verify_admin_login();

        $this->getView('admin');
        $view = new Admin_page_view();
        $this->getModel('admin');
        $model = new AdminModel('marque');
        $brand = $model->first(['idMarque' => $idMarque]);
        $view->page_head(["vehicles_management.css", "menu.css"], 'Edit Brand');
        $view->show_menu();
        $view->edit_brand_form($brand);
        $view->page_foot('');
    }

    public function edit_brand($idMarque)
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->editBrand($idMarque);
        redirect('/admin/show_vehicles_management');
    }
    public function delete_brand($idMarque)
    {
        $this->getModel('admin');
        $model = new AdminModel();
        $model->deleteBrand($idMarque);
        redirect('/admin/show_vehicles_management');
    }


    // feedback management actions
    public function show_feedback_management()
    {
        echo "this is the feedback management page";
    }
    // website settings management
    public function show_settings()
    {
        echo "this is the settings management page";
    }
}
