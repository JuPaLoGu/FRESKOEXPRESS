<a href="index.php?action=products">⬅ Volver</a> |
<a href="index.php?action=logout">Cerrar sesión</a>

<h2>Crear Producto</h2>
<?php if (isset($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <label>Proveedor:</label><br>
<select name="supplier_id" required>
    <option value="">Seleccione un proveedor</option>

    <?php while ($sup = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>
        <option value="<?= $sup["supplier_id"] ?>">
            <?= $sup["company_name"] ?> (ID: <?= $sup["supplier_id"] ?>)
        </option>
    <?php endwhile; ?>

</select><br><br>
    <input type="text" name="name" placeholder="Nombre" required><br><br>
    <input type="text" name="description" placeholder="Descripción"><br><br>
    <input type="number" step="0.01" name="price" placeholder="Precio" required><br><br>
    <input type="date" name="expiration_date"><br><br>
    <input type="number" name="stock" placeholder="Stock"><br><br>

    <button type="submit">Guardar</button>
</form>