<?php require_once __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-5" style="max-width: 350px;">
    <h3 class="mb-4 text-center">Iniciar Sesión</h3>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="index.php?controller=auth&action=login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-warning text-dark w-100">Iniciar sesión</button>
    </form>
</div>
<?php require_once __DIR__ . '/../layout/footer.php'; ?>