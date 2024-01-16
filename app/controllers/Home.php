<?php

class Home
{
    use Controller;

    public function show_homepage($message = '')
    {
        $this->getView('homepage');
        $this->getView('comparator');
        $this->getModel('home');
        $this->getModel('brand');
        $this->getModel('comparator');
        $this->getModel('vehicle');
        $view = new HomepageView();
        $compView = new ComparatorView();
        $homeModel = new HomeModel();
        $brandsModel = new BrandModel();
        $compModel = new ComparatorModel();
        $vehicleModel = new VehicleModel();

        $diaporama = $homeModel->getDiaporama();
        $brands = $brandsModel->getAllBrands();
        for ($i = 0; $i < count($brands); $i++) {
            $brandImages = $brandsModel->getBrandImages($brands[$i]['idMarque']);
            $brands[$i]['logo'] = $brandImages[0]['imageURL'];
        }

        $mostPopularComparisons = $compModel->getMostPopularComparisons();

        for ($i = 0; $i < count($mostPopularComparisons); $i++) {
            $idVehicle1 = $mostPopularComparisons[$i]['idVehicle1'];
            $idVehicle2 = $mostPopularComparisons[$i]['idVehicle2'];
            // vehicle 1 infos
            $vehicle1 = $vehicleModel->getVehicle($idVehicle1);
            $infosVehicle1 = $vehicleModel->getVehicleInfos($idVehicle1);
            $imageVehicle1 = $vehicleModel->getVehicleImage($idVehicle1);
            $vehicle1['brand'] = $infosVehicle1['marque']['nameMarque'];
            $vehicle1['model'] = $infosVehicle1['modele']['nameModele'];
            $vehicle1['version'] = $infosVehicle1['version']['valueVersion'];
            $vehicle1['image'] = $imageVehicle1['imageURL'] ?? 'vehicles/default_vehicle.webp';
            // vehicle 2 infos
            $vehicle2 = $vehicleModel->getVehicle($idVehicle2);
            $infosVehicle2 = $vehicleModel->getVehicleInfos($idVehicle2);
            $imageVehicle2 = $vehicleModel->getVehicleImage($idVehicle2);
            $vehicle2['brand'] = $infosVehicle2['marque']['nameMarque'];
            $vehicle2['model'] = $infosVehicle2['modele']['nameModele'];
            $vehicle2['version'] = $infosVehicle2['version']['valueVersion'];
            $vehicle2['image'] = $imageVehicle2['imageURL'] ?? 'vehicles/default_vehicle.webp';
            $mostPopularComparisons[$i]['vehicle1'] = $vehicle1;
            $mostPopularComparisons[$i]['vehicle2'] = $vehicle2;
        }

        $view->page_head(["view.css"], "Homepage");
        $view->show_page_header();
        $view->show_diaporama($diaporama);
        $view->show_menu();
        // homepage content
        $view->show_brands_logos($brands);
        $compView->show_comparator($brands, $message);
        $compView->most_searched_comparsions($mostPopularComparisons);


        $view->show_page_footer();
        $view->page_foot("view.js");
    }
}
