<?php

class UserModel
{
    use Model;

    protected $table = 'user';
    protected $allowedColumns = ["firstName", "lastName", "sex", "birthDate", "email", "password", "is_admin"];

    public function verify_email_exists($email)
    {
        $result = $this->where(["email" => $email]);
        if (is_array($result)) {
            if (count($result) > 0) return true;
        }
        return false;
    }

    public function insert_user()
    {
        unset($_POST['conf_pwd']);
        $this->insert($_POST);
    }

    public function get_user()
    {
        $user = $this->first($_POST);
        return $user;
    }
}
