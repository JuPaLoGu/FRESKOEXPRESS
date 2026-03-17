<h2>Editar Producto</h2>

<a href="index.php?action=products">⬅ Volver</a> |
<a href="index.php?action=logout">Cerrar sesión</a>

<?php if (isset($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $product["product_id"] ?>">

    <label>Proveedor:</label><br>
    <select name="supplier_id">
        <?php while ($sup = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= $sup["supplier_id"] ?>"
                <?= $sup["supplier_id"] == $product["supplier_id"]
                    ? "selected"
                    : "" ?>>
                <?= $sup["company_name"] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="text" name="name" value="<?= $product["name"] ?>"><br><br>
    <input type="text" name="description" value="<?= $product[
        "description"
    ] ?>"><br><br>
    <input type="number" step="0.01" name="price" value="<?= $product[
        "price"
    ] ?>"><br><br>
    <input type="date" name="expiration_date" value="<?= $product[
        "expiration_date"
    ] ?>"><br><br>
    <input type="number" name="stock" value="<?= $product["stock"] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>