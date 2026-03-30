<h1>Alta de Vehículo</h1>

<form action="/public/vehicles/store" method="post" class="card">
    <label>Tipo</label>
    <select name="tipoVehiculo" required id="tipoVehiculo">
        <option value="">Selecciona...</option>
        <option value="Coche">Coche</option>
        <option value="Motocicleta">Motocicleta</option>
    </select>

    <label>Marca</label>
    <input type="text" name="marca" required>

    <label>Modelo</label>
    <input type="text" name="modelo" required>

    <label>Matrícula</label>
    <input type="text" name="matricula" required>

    <label>Precio por día</label>
    <input type="number" step="0.01" name="precioDia" required>

    <div id="camposCoche">
        <label>Número de puertas (Coche)</label>
        <input type="number" name="numeroPuertas">

        <label>Tipo combustible (Coche)</label>
        <select name="tipoCombustible">
            <option value="">Selecciona...</option>
            <option value="diesel">diesel</option>
            <option value="gasolina">gasolina</option>
            <option value="electrico">electrico</option>
            <option value="hibrido">hibrido</option>
        </select>
    </div>

    <div id="camposMoto">
        <label>Cilindrada (Motocicleta)</label>
        <input type="number" name="cilindrada">

        <label>
            <input type="checkbox" name="incluyeCasco">
            Incluye casco
        </label>
    </div>

    <button type="submit">Guardar</button>
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