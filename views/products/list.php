

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>

    <h1>Lista de Productos </h1>

    <p>Bienvenido, <?= $_SESSION["user"]["name"] ?> (<?= $_SESSION["user"][
     "role"
 ] ?>)</p>

    <!-- BOTÓN LOGOUT -->
    <a href="index.php?action=logout">Cerrar sesión</a>

    <br><br>

    <!-- MENSAJE DE ERROR -->
    <?php if (isset($_GET["error"])): ?>
        <p style="color:red;">
            <?= $_GET["error"] ?>
        </p>
    <?php endif; ?>

    <!-- BOTÓN CREAR PRODUCTO (SOLO ADMIN) -->
    <?php if ($_SESSION["user"]["role"] == "admin"): ?>
        <a href="index.php?action=create_product"> Crear producto</a>
        <br><br>
    <?php endif; ?>

    <!-- TABLA -->
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Proveedor</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($products as $row): ?>
        <tr>
            <td><?= $row["product_id"] ?></td>
            <td><?= $row["supplier_id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["description"] ?></td>
            <td><?= $row["price"] ?></td>
            <td><?= $row["stock"] ?></td>

            <td>
                <?php if ($_SESSION["user"]["role"] == "admin"): ?>
                    <a href="index.php?action=edit_product&id=<?= $row[
                        "product_id"
                    ] ?>"> Editar</a>
                    |
                    <a href="index.php?action=delete_product&id=<?= $row[
                        "product_id"
                    ] ?>" 
                       onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
                        Eliminar
                    </a>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>