<?php
class Login_admin
{
    use Controller;
    public function show_login_admin($message = '')
    {
        $this->getView("admin_login");
        $view = new Admin_login_view();
        $this->getModel("admin");
        $view->page_head(["login_admin.css"], 'Login Admin');
        $view->show_login_page($message);
        $view->page_foot("");
    }

    public function logout()
    {
        if (isset($_SESSION["idAdmin"])) {
            unset($_SESSION["idAdmin"]);
        }
        redirect("");
    }

    public function login()
    {
        if (isset($_SESSION['idAdmin'])) {
            redirect("/admin/show_admin_page");
        }
        $this->getModel("admin");
        $model = new AdminModel();
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $admin = $model->getAdmin();
            if ($admin) {
                $_SESSION["idAdmin"] = $admin["idUser"];
                redirect("/admin/show_admin_page");
            } else {
                $message = encode_message("false credentials");
                redirect("/login_admin/show_login_admin&message=" . $message);
            }
        }
    }
}
