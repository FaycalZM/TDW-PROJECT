<?php



class User
{
    use Controller;

    public function show_login_page($message = "")
    {
        $this->getView("user");
        $view = new UserView();
        $view->page_head(["user.css", "view.css"], "Login");
        $view->show_page_header();
        $view->show_menu();
        $view->show_login_form($message);
        $view->show_page_footer();
        $view->page_foot("");
    }

    public function show_signup_page($message = "")
    {
        $this->getView("user");
        $view = new UserView();
        $view->page_head(["view.css", "user.css"], "Signup");
        $view->show_page_header();
        $view->show_menu();
        $view->show_signup_form($message);
        $view->show_page_footer();
        $view->page_foot("");
    }

    public function signup()
    {
        $this->getModel("user");
        $model = new UserModel();
        $message = "";
        if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['sex']) && isset($_POST['birthDate']) && isset($_POST['password']) && isset($_POST['conf_pwd'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && ($_POST['password'] === $_POST['conf_pwd'])) {
                if (!$model->verify_email_exists($_POST['email'])) {
                    $model->insert_user();
                    redirect("/user/show_login_page");
                } else {
                    $message = encode_message("Email already exists");
                    redirect("/user/show_signup_page&message=" . $message);
                }
            } else {
                $message = encode_message("invalid email or password");
                redirect("/user/show_signup_page&message=" . $message);
            }
        }
    }

    public function login()
    {
        $this->getModel("user");
        $model = new UserModel();
        $message = "";
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $user = $model->get_user();
                if ($user) {
                    if ($user['is_valid'] == 1) {
                        // login successful, user is validated 
                        $_SESSION["id"] = $user["idUser"];
                        redirect("");
                    } else {
                        // must wait for the admin's validation
                        $message = encode_message("user is not validated");
                        redirect("/user/show_login_page&message=" . $message);
                    }
                } else {
                    $message = encode_message("incorrect email or password");

                    redirect("/user/show_login_page&message=" . $message);
                }
            } else {
                $message = encode_message("invalid email");
                redirect("/user/show_login_page&message=" . $message);
            }
        } else {
            redirect("/user/show_login_page");
        }
    }

    public function logout()
    {
        if (isset($_SESSION["id"])) {
            unset($_SESSION["id"]);
        }
        redirect("");
    }

    // user profile 
    public function show_profile($userId)
    {
        $this->getView('homepage');
        $this->getModel('home');
        $this->getModel('user');
        $this->getModel('vehicle');
        $this->getModel('brand');


        $view = new HomepageView();
        $homeModel = new HomeModel();
        $userModel = new UserModel();
        $vehicleModel = new VehicleModel();
        $brandModel = new BrandModel();

        // get all user's related infos
        $user = $userModel->getUserById($userId);
        $favoriteVehicles = $userModel->getUserFavoriteVehicles($userId);
        $brandsFeedback = $userModel->getUserBrandsFeedback($userId);
        $vehiclesFeedback = $userModel->getUserVehiclesFeedback($userId);
        $brandsRating = $userModel->getUserBrandsRating($userId);
        $vehiclesRating = $userModel->getUserVehiclesRating($userId);

        // get vehicle infos and image for each favorite vehicle
        for ($i = 0; $i < count($favoriteVehicles); $i++) {
            $idVehicle = $favoriteVehicles[$i]['idVehicle'];
            $image = $vehicleModel->getVehicleImage($idVehicle);
            $vehicle = $vehicleModel->getVehicle($idVehicle);
            $favoriteVehicles[$i]['image'] = $image ? $image['imageURL'] : "vehicles/default_vehicle.webp";
            $favoriteVehicles[$i]['vehicle'] = $vehicle;
        }
        // get brand name for each brand feedback
        for ($i = 0; $i < count($brandsFeedback); $i++) {
            $idBrand = $brandsFeedback[$i]['idMarque'];
            $brand = $brandModel->getBrand($idBrand);
            $brandsFeedback[$i]['brand'] = $brand;
        }
        // get vehicle name for each vehicle feedback
        for ($i = 0; $i < count($vehiclesFeedback); $i++) {
            $idVehicle = $vehiclesFeedback[$i]['idVehicle'];
            $vehicle = $vehicleModel->getVehicle($idVehicle);
            $vehiclesFeedback[$i]['vehicle'] = $vehicle;
        }
        // get user's rating for each brand
        for ($i = 0; $i < count($brandsRating); $i++) {
            $idBrand = $brandsRating[$i]['idMarque'];
            $brand = $brandModel->getBrand($idBrand);
            $brandsRating[$i]['brand'] = $brand;
        }
        // get user's rating for each vehicle
        for ($i = 0; $i < count($vehiclesRating); $i++) {
            $idVehicle = $vehiclesRating[$i]['idVehicle'];
            $vehicle = $vehicleModel->getVehicle($idVehicle);
            $vehiclesRating[$i]['vehicle'] = $vehicle;
        }
        $user['favorites'] = $favoriteVehicles;
        $user['brandsFeedback'] = $brandsFeedback;
        $user['vehiclesFeedback'] = $vehiclesFeedback;
        $user['brandsRating'] = $brandsRating;
        $user['vehiclesRating'] = $vehiclesRating;


        $view->page_head(["view.css", "user_profile.css"], "User profile");
        $view->show_page_header();
        $view->show_menu();

        $view->user_profile_page($user);

        $view->show_page_footer();
        $view->page_foot("");
    }

    public function add_favorite_vehicle($idUser, $idVehicle)
    {
        $this->getModel('user');
        $userModel = new UserModel();
        $userModel->addFavoriteVehicle($idUser, $idVehicle);
        redirect("/brands/show_vehicle_details&idVehicle=$idVehicle");
    }

    public function remove_favorite_vehicle($idUser, $idVehicle)
    {
        $this->getModel('user');
        $userModel = new UserModel();
        $userModel->deleteFavoriteVehicle($idUser, $idVehicle);
        redirect("/brands/show_vehicle_details&idVehicle=$idVehicle");
    }
}
