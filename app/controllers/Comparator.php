<?php

class Comparator
{
    use Controller;

    public function areAllDropdownsSelected($group)
    {
        return $group['brand'] !== '' &&
            $group['model'] !== '' &&
            $group['version'] !== '' &&
            $group['vehicle'] !== '';
    }

    // Function to validate the form data
    function validateForm(&$formData)
    {
        // Count the number of groups with selected options
        $selectedGroups = array_filter($formData, function ($group) {
            return $group['brand'] !== '' &&
                $group['model'] !== '' &&
                $group['version'] !== '' &&
                $group['vehicle'] !== '';
        });



        // Check if at least 2 groups are selected
        if (count($selectedGroups) < 2) {
            return "Please select at least 2 vehicles .";
        } else {
            // check if all fields have been filled
            foreach ($selectedGroups as $group) {
                if (!$this->areAllDropdownsSelected($group)) return "Please fill all fields.";
            }
        }

        $formData = $selectedGroups;


        // Check if the selected vehicles are different
        $selectedVehicles = array_map(function ($group) {
            return $group['brand'] . '_' . $group['model'] . '_' . $group['version'] . '_' . $group['vehicle'];
        }, $selectedGroups);

        if (count($selectedVehicles) !== count(array_unique($selectedVehicles))) {
            return "Please choose different vehicles in each group.";
        }

        return null;
    }

    function getAllPossibleCombinations($array)
    {
        $combinations = [];
        $arrayCount = count($array);

        for ($i = 0; $i < $arrayCount - 1; $i++) {
            for ($j = $i + 1; $j < $arrayCount; $j++) {
                $combinations[] = [$array[$i], $array[$j]];
            }
        }

        return $combinations;
    }

    public function show_comparator_page($message = "")
    {
        $this->getView('homepage');
        $this->getView('comparator');
        $this->getModel('comparator');
        $this->getModel('brand');
        $this->getModel('vehicle');
        $view = new HomepageView();
        $compView = new ComparatorView();
        $compModel = new ComparatorModel();
        $brandsModel = new BrandModel();
        $vehicleModel = new VehicleModel();

        $brands = $brandsModel->getAllBrands();

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
        $view->show_menu();
        // Comparator page content
        $compView->show_comparator($brands, $message);
        $compView->most_searched_comparsions($mostPopularComparisons);


        $view->show_page_footer();
        $view->page_foot("view.js");
    }

    public function show_comparison_page()
    {
        $this->getView('comparator');
        $this->getModel('home');
        $this->getModel('comparator');
        $this->getModel('vehicle');
        $view = new ComparatorView();
        $homeModel = new HomeModel();
        $compModel = new ComparatorModel();
        $vehicleModel = new VehicleModel();

        // form data (table of tables)
        $formData = [
            [
                'brand' => isset($_POST['brand1']) ? $_POST['brand1'] : '',
                'model' => isset($_POST['model1']) ? $_POST['model1'] : '',
                'version' => isset($_POST['version1']) ? $_POST['version1'] : '',
                'vehicle' => isset($_POST['vehicle1']) ? $_POST['vehicle1'] : ''
            ],
            [
                'brand' => isset($_POST['brand2']) ? $_POST['brand2'] : '',
                'model' => isset($_POST['model2']) ? $_POST['model2'] : '',
                'version' => isset($_POST['version2']) ? $_POST['version2'] : '',
                'vehicle' => isset($_POST['vehicle2']) ? $_POST['vehicle2'] : ''
            ],
            [
                'brand' => isset($_POST['brand3']) ? $_POST['brand3'] : '',
                'model' => isset($_POST['model3']) ? $_POST['model3'] : '',
                'version' => isset($_POST['version3']) ? $_POST['version3'] : '',
                'vehicle' => isset($_POST['vehicle3']) ? $_POST['vehicle3'] : ''
            ],
            [
                'brand' => isset($_POST['brand4']) ? $_POST['brand4'] : '',
                'model' => isset($_POST['model4']) ? $_POST['model4'] : '',
                'version' => isset($_POST['version4']) ? $_POST['version4'] : '',
                'vehicle' => isset($_POST['vehicle4']) ? $_POST['vehicle4'] : ''
            ]
        ];

        $validationError = $this->validateForm($formData);

        // Transform the array to keep only the "vehicle" attribute
        $vehicleData = array_map(function ($group) {
            return $group['vehicle'];
        }, $formData);


        if ($validationError) {
            redirect("/home/show_homepage&message=" . encode_message($validationError));
        }

        // Form is valid : we proceed to comparison

        // combinations are needed to store the history of vehicles comparisonss
        $combinations = $this->getAllPossibleCombinations($vehicleData);

        foreach ($combinations as $combination) {
            // insert the comparison in the DB
            $compModel->insertComparison($combination[0], $combination[1]);
        }



        // getting vehicles infos and images
        $vehicles = [];
        foreach ($vehicleData as $idVehicle) {
            $vehicles[] = $vehicleModel->getVehicle($idVehicle);
        }

        for ($i = 0; $i < count($vehicles); $i++) {
            $infos = $vehicleModel->getVehicleInfos($vehicles[$i]['idVehicle']);
            $image = $vehicleModel->getVehicleImage($vehicles[$i]['idVehicle']);
            $vehicles[$i]['brand'] = $infos['marque']['nameMarque'];
            $vehicles[$i]['model'] = $infos['modele']['nameModele'];
            $vehicles[$i]['version'] = $infos['version']['valueVersion'];
            $vehicles[$i]['image'] =  $image['imageURL'] ?? 'vehicles/default_vehicle.webp';
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

        $view->page_head(["view.css", "comparator.css"], "Homepage");
        $view->show_page_header();
        $view->show_menu();
        // homepage content

        $view->comparison_table($vehicles);
        $view->most_searched_comparsions($mostPopularComparisons);


        $view->show_page_footer();
        $view->page_foot("view.js");
    }

    public function get_brands()
    {
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $brands = $brandModel->getAllBrands();
        // Encode the data as JSON
        $json = json_encode($brands);

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Output the JSON data
        echo $json;
    }

    public function get_brand_models($idMarque)
    {
        $this->getModel('comparator');
        $compModel = new ComparatorModel();

        $brandModels = $compModel->getBrandModels($idMarque);
        // Encode the data as JSON
        $json = json_encode($brandModels);

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Output the JSON data
        echo $json;
    }
    public function get_model_versions($idModel)
    {
        $this->getModel('comparator');
        $compModel = new ComparatorModel();

        $modelVersions = $compModel->getModelVersions($idModel);
        // Encode the data as JSON
        $json = json_encode($modelVersions);

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Output the JSON data
        echo $json;
    }
    public function get_version_vehicles($idVersion)
    {
        $this->getModel('comparator');
        $compModel = new ComparatorModel();

        $versionVehicles = $compModel->getVersionVehicles($idVersion);
        // Encode the data as JSON
        $json = json_encode($versionVehicles);

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Output the JSON data
        echo $json;
    }
}
