<?php

require_once __DIR__ .  '/../models/City.php';

class CityController
{
    public function index()
    {
        $cityModel = new City();
        $search = $_GET['q'] ?? '';

        // Paginación
        $limit = 5;
        $page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
        $offset = ($page - 1) * $limit;

        if ($search) {
            $citys = $cityModel->search($search); // Puedes paginar búsqueda también si lo deseas
            $totalCitys = count($citys); // rápida solución, aunque no ideal
        } else {
            $citys = $cityModel->getAll($limit, $offset);
            $totalCitys = $cityModel->countAll();
        }

        $totalPages = ceil($totalCitys / $limit);

        include __DIR__ . '/../views/cities/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/cities/create.php';
    }

    public function edit($id) {
        $cityModel = new City();
        $city = $cityModel->find($id);

        if (!$city) {
            die("Ciudad no encontrado");
        }

        include __DIR__ . '/../views/cities/edit.php';
    }


    public function store($city){
        $errors = [];

    if (empty($city)) {
        $errors[] = "El nombre es obligatorio.";
    }

    if (count($errors) > 0) {
        $oldData = ['city' =>$city];
        include __DIR__ . '/../views/cities/create.php';
        return;
    } 
        $cityModel = new City();
        $cityModel -> create($city);

        header("location: index.php?controller=city&action=index&success=1");
    
    }

    public function update($id, $city) {
        $errors = [];
    
        if (empty($city)) $errors[] = "El nombre es obligatorio.";
       
        elseif (!filter_var($city)) $errors[] = "Ciudad inválido.";
    
        if ($errors) {
            $city = ['id' => $id, 'city' => $city];
            include __DIR__ . '/../views/cities/edit.php';
        } else {
            $cityModel = new City();
            $cityModel->update($id, $city);
            header("Location: index.php?controller=city&action=index&updated=1");
            exit;
        }
    }

    public function delete() {
        $id = (int) $_GET['id'];
        $cityModel = new City();
        $cityModel->delete($id);
        header("Location: index.php?controller=city&action=index&deleted=1");
        exit;
    }
}


