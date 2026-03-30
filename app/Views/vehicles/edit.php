<h1>Editar Vehículo</h1>

<form action="/public/vehicles/update" method="post" class="card">
    <input type="hidden" name="id" value="<?= $v['id'] ?>">

    <label>Tipo</label>
    <select name="tipoVehiculo" required id="tipoVehiculo">
        <option value="Coche" <?= $v['tipoVehiculo'] === 'Coche' ? 'selected' : '' ?>>Coche</option>
        <option value="Motocicleta" <?= $v['tipoVehiculo'] === 'Motocicleta' ? 'selected' : '' ?>>Motocicleta</option>
    </select>

    <label>Marca</label>
    <input type="text" name="marca" required value="<?= htmlspecialchars($v['marca']) ?>">

    <label>Modelo</label>
    <input type="text" name="modelo" required value="<?= htmlspecialchars($v['modelo']) ?>">

    <label>Matrícula</label>
    <input type="text" name="matricula" required value="<?= htmlspecialchars($v['matricula']) ?>">

    <label>Precio por día</label>
    <input type="number" step="0.01" name="precioDia" required value="<?= htmlspecialchars($v['precioDia']) ?>">

    <div id="camposCoche">
        <label>Número de puertas (Coche)</label>
        <input type="number" name="numeroPuertas" value="<?= htmlspecialchars((string)$v['numeroPuertas']) ?>">

        <label>Tipo combustible (Coche)</label>
        <select name="tipoCombustible">
            <?php
                $comb = (string)$v['tipoCombustible'];
                $opts = ['diesel', 'gasolina', 'electrico', 'hibrido'];
                foreach ($opts as $o) {
                    $sel = ($comb === $o) ? 'selected' : '';
                    echo "<option value=\"{$o}\" {$sel}>{$o}</option>";
                }
            ?>
        </select>
    </div>

    <div id="camposMoto">
        <label>Cilindrada (Motocicleta)</label>
        <input type="number" name="cilindrada" value="<?= htmlspecialchars((string)$v['cilindrada']) ?>">

        <label>
            <input type="checkbox" name="incluyeCasco" <?= ((int)$v['incluyeCasco'] === 1) ? 'checked' : '' ?>>
            Incluye casco
        </label>
    </div>

    <button type="submit">Actualizar</button>
</form>

<script>
const tipo = document.getElementById('tipoVehiculo');
const coche = document.getElementById('camposCoche');
const moto = document.getElementById('camposMoto');

function toggleCampos() {
    const t = tipo.value;
    coche.style.display = (t === 'Coche') ? 'block' : 'none';
    moto.style.display = (t === 'Motocicleta') ? 'block' : 'none';
}
tipo.addEventListener('change', toggleCampos);
toggleCampos();
</script>