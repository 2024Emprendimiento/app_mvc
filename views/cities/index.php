<?php require_once __DIR__ . '/../layout/header.php'; ?>
<!-- Opcion de busqueda -->
<form method="GET" action="index.php" class="mb-3 row g-2">
    <input type="hidden" name="controller" value="city">
    <input type="hidden" name="action" value="index">

    <div class="col-auto">
        <input type="text" name="q" class="form-control" placeholder="Buscar..." value="<?= $_GET['q'] ?? '' ?>">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-secondary">Buscar</button>
    </div>
</form>


<h2>Listado de ciudades</h2>
<a href="index.php?controller=city&action=create" class="btn btn-info mb-2">Ingresa una nueva ciudad</a>

<!-- <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Usuario registrado correctamente.</div>
<?php endif; ?> -->

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Ciudad registrada correctamente.</div>
<?php elseif (isset($_GET['updated'])): ?>
    <div class="alert alert-success">Ciudad actualizada.</div>
<?php elseif (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Ciudad eliminada.</div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($citys as $city): ?>
            <tr>
                <td><?= htmlspecialchars($city['city']) ?></td>
                <td>
                    <a href="index.php?controller=city&action=edit&id=<?= $city['id'] ?>" class="btn btn-info btn-sm">Editar</a>
                    <a href="index.php?controller=city&action=delete&id=<?= $city['id'] ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Estás seguro de eliminar esta ciudad?')">
                        Eliminar
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($totalPages > 1): ?>
    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?controller=city&action=index&page=<?= $page - 1 ?>&q=<?= $search ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=city&action=index&page=<?= $i ?>&q=<?= $search ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?controller=city&action=index&page=<?= $page + 1 ?>&q=<?= $search ?>">Siguiente</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>




<?php require_once __DIR__ . '/../layout/footer.php'; ?>