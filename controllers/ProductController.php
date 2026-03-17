<?php
require_once __DIR__ . "/../models/Product.php";

class ProductController
{
    public function index()
    {
        $model = new Product();
        $products = $model->getAll();

        require_once __DIR__ . "/../views/products/list.php";
    }

    public function create()
    {
        $model = new Product();
        $suppliers = $model->getSuppliers(); //  traer suppliers

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $supplier_id = $_POST["supplier_id"];

            if (!$model->supplierExists($supplier_id)) {
                $error = "El supplier no existe ❌";
                require __DIR__ . "/../views/products/create.php";
                return;
            }

            $model->create(
                $supplier_id,
                $_POST["name"],
                $_POST["description"],
                $_POST["price"],
                $_POST["expiration_date"],
                $_POST["stock"],
            );

            header("Location: index.php?action=products");
        } else {
            require __DIR__ . "/../views/products/create.php";
        }
    }
    public function edit()
    {
        $model = new Product();
        $suppliers = $model->getSuppliers();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];

            if (!$model->supplierExists($_POST["supplier_id"])) {
                $error = "El supplier no existe ❌";
                $product = $model->getById($id);
                require __DIR__ . "/../views/products/edit.php";
                return;
            }

            $model->update(
                $id,
                $_POST["supplier_id"],
                $_POST["name"],
                $_POST["description"],
                $_POST["price"],
                $_POST["expiration_date"],
                $_POST["stock"],
            );

            header("Location: index.php?action=products");
        } else {
            $id = $_GET["id"];
            $product = $model->getById($id);
            require __DIR__ . "/../views/products/edit.php";
        }
    }
}
