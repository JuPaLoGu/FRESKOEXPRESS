<?php
session_start();

require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/ProductController.php";

$action = $_GET["action"] ?? "login";

//  RUTAS PÚBLICAS (sin login)
$publicRoutes = ["login"];

if (!in_array($action, $publicRoutes) && !isset($_SESSION["user"])) {
    header("Location: index.php?action=login");
    exit();
}

switch ($action) {
    //  LOGIN
    case "login":
        $controller = new AuthController();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller->login();
        } else {
            require_once __DIR__ . "/views/login.php";
        }
        break;

    //  LOGOUT
    case "logout":
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit();

    //  DASHBOARD
    case "dashboard":
        echo "<h1>Bienvenido " . $_SESSION["user"]["name"] . " </h1>";
        echo "<p>Rol: " . $_SESSION["user"]["role"] . "</p>";
        echo "<a href='index.php?action=products'>Ir a productos</a><br>";
        echo "<a href='index.php?action=logout'>Cerrar sesión</a>";
        break;

    //  LISTAR PRODUCTOS
    case "products":
        if ($_SESSION["user"]["role"] != "admin") {
            echo "Acceso denegado ❌";
            exit();
        }

        $controller = new ProductController();
        $controller->index();
        break;

    //  CREAR PRODUCTO
    case "create_product":
        if ($_SESSION["user"]["role"] != "admin") {
            echo "Acceso denegado ❌";
            exit();
        }

        $controller = new ProductController();
        $controller->create();
        break;

    //  EDITAR PRODUCTO
    case "edit_product":
        if ($_SESSION["user"]["role"] != "admin") {
            echo "Acceso denegado ❌";
            exit();
        }

        $controller = new ProductController();
        $controller->edit();
        break;

    //  ELIMINAR PRODUCTO
    case "delete_product":
        if ($_SESSION["user"]["role"] != "admin") {
            echo "Acceso denegado ❌";
            exit();
        }

        $controller = new ProductController();
        $controller->delete();
        break;

    //  DEFAULT
    default:
        require_once __DIR__ . "/views/login.php";
        break;
}
