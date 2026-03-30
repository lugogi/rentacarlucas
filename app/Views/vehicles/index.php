<h1>Listado de Flota</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Matrícula</th>
            <th>Precio/día</th>
            <th>Características</th>
            <?php if (\App\Core\Session::has('user_id')): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicles as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= htmlspecialchars($v['tipoVehiculo']) ?></td>
                <td><?= htmlspecialchars($v['marca']) ?></td>
                <td><?= htmlspecialchars($v['modelo']) ?></td>
                <td><?= htmlspecialchars($v['matricula']) ?></td>
                <td><?= number_format((float)$v['precioDia'], 2) ?> €</td>
                <td>
                    <?php if ($v['tipoVehiculo'] === 'Coche'): ?>
                        Puertas: <?= (int)$v['numeroPuertas'] ?> |
                        Combustible: <?= htmlspecialchars((string)$v['tipoCombustible']) ?>
                    <?php else: ?>
                        Cilindrada: <?= (int)$v['cilindrada'] ?>cc |
                        Casco: <?= ((int)$v['incluyeCasco'] === 1) ? 'Sí' : 'No' ?>
                    <?php endif; ?>
                </td>
                <?php if (\App\Core\Session::has('user_id')): ?>
                    <td>
                        <a href="/public/vehicles/edit?id=<?= $v['id'] ?>">Editar</a>
                        <form action="/public/vehicles/delete" method="post" style="display:inline">
                            <input type="hidden" name="id" value="<?= $v['id'] ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar vehículo?')">Eliminar</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>