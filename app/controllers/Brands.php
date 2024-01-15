<?php

class Brands
{
    use Controller;

    public function show_brands_page()
    {
        $this->getView('homepage');
        $this->getModel('brand');
        $view = new HomepageView();
        $brandsModel = new BrandModel();

        // get all brands with their logos
        $brands = $brandsModel->getAllBrands();
        for ($i = 0; $i < count($brands); $i++) {
            $brandImages = $brandsModel->getBrandImages($brands[$i]['idMarque']);
            $brands[$i]['logo'] = $brandImages[0]['imageURL'];
        }

        $view->page_head(["view.css", "brands_page.css"], "Brands page");
        $view->show_page_header();
        $view->show_menu();
        // homepage content
        $view->show_brands_logos($brands, true);

        $view->show_page_footer();
        $view->page_foot("");
    }

    public function show_brand_details($idMarque)
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

        $view->brand_details_page($brand, $images, $brandVehicles, $brandFeedback);
        $view->show_page_footer();
        $view->page_foot("");
    }

    public function vehicle_details()
    {
        $idVehicle = $_POST['idVehicle'];
        redirect("/brands/show_vehicle_details&idVehicle=$idVehicle");
    }

    public function show_vehicle_details($idVehicle)
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

        // get vehicle infos (version, modele, marque)
        $vehicleInfos = $vehicleModel->getVehicleInfos($idVehicle);
        // get vehicle 
        $vehicle = $vehicleModel->getVehicle($idVehicle);
        // set vehicle infos
        $vehicle['version'] = $vehicleInfos['version'];
        $vehicle['modele'] = $vehicleInfos['modele'];
        $vehicle['marque'] = $vehicleInfos['marque'];
        // get vehicle images
        $vehicleImages = $vehicleModel->getVehicleImages($idVehicle);
        // get vehicle feedback
        $vehicleFeedback = $vehicleModel->getVehicleMostAppreciatedFeedback($idVehicle);
        for ($i = 0; $i < count($vehicleFeedback); $i++) {
            $user = $userModel->getUserById($vehicleFeedback[$i]['idUser']);
            $vehicleFeedback[$i]['user'] = $user;
        }
        $isFavorite = false;
        if (isset($_SESSION['id'])) {
            $idUser = $_SESSION['id'];
            // user is logged in -> check if the vehicle is in their favorites list 
            $isFavorite = $userModel->checkFavoriteExists($idUser, $idVehicle);
        }

        // display
        $view->page_head(["view.css", "brands_page.css", "vehicle_details.css"], "Vehicle Details");
        $view->show_page_header();
        $view->show_menu();

        $view->vehicle_details_page($vehicle, $vehicleImages, $vehicleFeedback, $isFavorite);

        $view->show_page_footer();
        $view->page_foot("");
    }
    // rate a brand
    public function rate_brand($idMarque)
    {
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $idUser = $_SESSION['id'];
        $brandModel->rateBrand($idMarque, $idUser);
        redirect("/brands/show_brand_details&idMarque=$idMarque");
    }
    // feedback a brand
    public function feedback_brand($idMarque)
    {
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $idUser = $_SESSION['id'];
        $brandModel->feedbackBrand($idMarque, $idUser);
        redirect("/brands/show_brand_details&idMarque=$idMarque");
    }
    // rate a vehicle
    public function rate_vehicle($idVehicle)
    {
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $idUser = $_SESSION['id'];
        $vehicleModel->rateVehicle($idVehicle, $idUser);
        redirect("/brands/show_vehicle_details&idVehicle=$idVehicle");
    }
    // feedback a vehicle
    public function feedback_vehicle($idVehicle)
    {
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $idUser = $_SESSION['id'];
        $vehicleModel->feedbackVehicle($idVehicle, $idUser);
        redirect("/brands/show_vehicle_details&idVehicle=$idVehicle");
    }
}
