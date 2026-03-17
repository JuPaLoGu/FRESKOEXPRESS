<?php
require_once __DIR__ . "/../config/database.php";

class Product
{
    private $conn;
    private $table = "products";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // LISTAR
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREAR
    public function create(
        $supplier_id,
        $name,
        $description,
        $price,
        $expiration_date,
        $stock,
    ) {
        $query =
            "INSERT INTO " .
            $this->table .
            " 
        (supplier_id, name, description, price, expiration_date, stock)
        VALUES (:supplier_id, :name, :description, :price, :expiration_date, :stock)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":supplier_id", $supplier_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":expiration_date", $expiration_date);
        $stmt->bindParam(":stock", $stock);

        return $stmt->execute();
    }

    // ELIMINAR
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE product_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    //Error Supplier inexistente
    public function supplierExists($supplier_id)
    {
        $query =
            "SELECT supplier_id FROM suppliers WHERE supplier_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $supplier_id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function getSuppliers()
    {
        $query = "SELECT supplier_id, company_name FROM suppliers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getById($id)
    {
        $query = "SELECT * FROM products WHERE product_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(
        $id,
        $supplier_id,
        $name,
        $description,
        $price,
        $expiration_date,
        $stock,
    ) {
        $query = "UPDATE products SET 
        supplier_id = :supplier_id,
        name = :name,
        description = :description,
        price = :price,
        expiration_date = :expiration_date,
        stock = :stock
        WHERE product_id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":supplier_id", $supplier_id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":expiration_date", $expiration_date);
        $stmt->bindParam(":stock", $stock);

        return $stmt->execute();
    }
}
