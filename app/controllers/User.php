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
                    $_SESSION["id"] = $user["idUser"];
                    redirect("");
                } else {
                    $message = encode_message("incorrect email or password");
                    show($message);
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
        $this->getModel("user");
        $model = new UserModel();
        if (isset($_SESSION["id"])) {
            unset($_SESSION["id"]);
        }
        redirect("");
    }
}
