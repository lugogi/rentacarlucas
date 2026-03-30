<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent-a-Car Fleet</title>
    <link rel="stylesheet" href="/public/assets/styles.css">
</head>
<body>
    <nav>
        <a href="/public">Flota</a>

        <?php if (\App\Core\Session::has('user_id')): ?>
            <a href="/public/vehicles/create">Alta Vehículo</a>
            <span>Usuario: <?= htmlspecialchars(\App\Core\Session::get('user_email')) ?></span>
            <form action="/public/logout" method="post" style="display:inline">
                <button type="submit">Logout</button>
            </form>
        <?php else: ?>
            <a href="/public/login">Login</a>
            <a href="/public/register">Registro</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php if ($msg = \App\Core\Session::flash('success')): ?>
            <p class="flash success"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <?php if ($msg = \App\Core\Session::flash('error')): ?>
            <p class="flash error"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <?= $content ?>
    </main>
</body>
</html>