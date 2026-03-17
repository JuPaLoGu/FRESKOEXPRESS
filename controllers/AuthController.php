<?php
require_once __DIR__ . "/../models/User.php";

class AuthController
{
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION["user"] = $user;

                header("Location: index.php?action=dashboard");
            } else {
                echo "Credenciales incorrectas";
            }
        }
    }
}
