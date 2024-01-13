<?php

class Feedback
{
    use Controller;

    public function show_feedback_page()
    {
        $this->getView('homepage');
        $this->getModel('brand');
        $view = new HomepageView();
        $brandsModel = new BrandModel();
        // get all brands with their images
        $brands = $brandsModel->getAllBrands();
        for ($i = 0; $i < count($brands); $i++) {
            $brandImages = $brandsModel->getBrandImages($brands[$i]['idMarque']);
            $brands[$i]['logo'] = $brandImages[0]['imageURL'];
        }

        $view->page_head(["view.css", "brands_page.css"], "Feedback page");
        $view->show_page_header();
        $view->show_menu();
        // homepage content
        $view->show_feedback_brands_logos($brands, true);

        $view->show_page_footer();
        $view->page_foot("");
    }

    public function show_brand_feedback($idMarque)
    {
        $this->getView('homepage');
        $view = new HomepageView();
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $this->getModel('home');
        $homeModel = new HomeModel();
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $this->getModel('user');
        $userModel = new UserModel();

        $brand = $brandModel->getBrand($idMarque);
        $brandNote = $brandModel->getBrandNote($idMarque);
        $brand['note'] = $brandNote;
        // get brand images
        $images = $brandModel->getBrandImages($idMarque);
        $image = $images[0];
        // get vehicles images
        $brandVehicles = $homeModel->getBrandVehicles($idMarque);
        for ($i = 0; $i < count($brandVehicles); $i++) {
            $vehicleImages = $vehicleModel->getVehicleImages($brandVehicles[$i]['idVehicle']);
            $brandVehicles[$i]['image'] = $vehicleImages[0]['imageURL'] ?? 'vehicles/default_vehicle.webp';
        }
        // get brand feedback
        $brandFeedback = $brandModel->getAllValidBrandFeedback($idMarque);
        for ($i = 0; $i < count($brandFeedback); $i++) {
            $user = $userModel->getUserById($brandFeedback[$i]['idUser']);
            $brandFeedback[$i]['user'] = $user;
        }

        $view->page_head(["view.css", "brands_page.css", "vehicle_details.css"], "Brand Details");
        $view->show_page_header();
        $view->show_menu();

        $view->brand_feedback_page($brand, $image, $brandVehicles, $brandFeedback);
        $view->show_page_footer();
        $view->page_foot("");
    }

    public function show_vehicle_feedback($idVehicle)
    {
        // get models and views
        $this->getView('homepage');
        $view = new HomepageView();
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $this->getModel('home');
        $homeModel = new HomeModel();
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $this->getModel('user');
        $userModel = new UserModel();

        // get vehicle 
        $vehicle = $vehicleModel->getVehicle($idVehicle);
        // get vehicle images
        $vehicleImages = $vehicleModel->getVehicleImages($idVehicle);
        $image = $vehicleImages ? $vehicleImages[0]['imageURL'] : 'vehicles/default_vehicle.webp';
        // get vehicle feedback
        $vehicleFeedback = $vehicleModel->getAllValidVehicleFeedback($idVehicle);
        for ($i = 0; $i < count($vehicleFeedback); $i++) {
            $user = $userModel->getUserById($vehicleFeedback[$i]['idUser']);
            $vehicleFeedback[$i]['user'] = $user;
        }
        // display
        $view->page_head(["view.css", "brands_page.css", "vehicle_details.css"], "Vehicle Details");
        $view->show_page_header();
        $view->show_menu();

        $view->vehicle_feedback_page($vehicle, $image, $vehicleFeedback);

        $view->show_page_footer();
        $view->page_foot("");
    }

    public function vehicle_feedback()
    {
        $idVehicle = $_POST['idVehicle'];
        redirect("/feedback/show_vehicle_feedback&idVehicle=$idVehicle");
    }




    public function like_brand_comment($idAvisMarque, $idMarque)
    {
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $brandModel->likeBrandComment($idAvisMarque);
        redirect("/brands/show_brand_details&idMarque=$idMarque");
    }

    public function like_vehicle_comment($idAvisVehicle, $idVehicle)
    {
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $vehicleModel->likeVehicleComment($idAvisVehicle);
        redirect("/brands/show_vehicle_details&idMarque=$idVehicle");
    }
}
