<?php
// controllers/ProductController.php

namespace App\Controllers;

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/ProductModel.php';

use App\Core\Controller;
use App\Models\ProductModel;

class ProductController extends Controller
{
    private ProductModel $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    // GET /produits
    public function index(): void
    {
        $produits = $this->model->getAll();
        $this->render('products/index', ['produits' => $produits]);
    }

    // GET /produits/create
    public function create(): void
    {
        $this->render('products/create');
    }

    // POST /produits/create
    public function store(): void
    {
        $data = [
            'nom'         => trim($_POST['nom'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'prix'        => $_POST['prix'] ?? 0,
        ];

        if ($data['nom'] === '' || $data['prix'] === '') {
            $this->render('products/create', ['error' => 'Le nom et le prix sont obligatoires.']);
            return;
        }

        $this->model->create($data);
        $this->redirect('/public/produits');
    }

    // GET /produits/{id}/edit
    public function edit(string $id): void
    {
        $produit = $this->model->find((int) $id);

        if (!$produit) {
            $this->redirect('/public/produits');
            return;
        }

        $this->render('products/edit', ['produit' => $produit]);
    }

    // POST /produits/{id}/edit
    public function update(string $id): void
    {
        $data = [
            'nom'         => trim($_POST['nom'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'prix'        => $_POST['prix'] ?? 0,
        ];

        $this->model->update((int) $id, $data);
        $this->redirect('/public/produits');
    }

    // POST /produits/{id}/delete
    public function destroy(string $id): void
    {
        $this->model->delete((int) $id);
        $this->redirect('/public/produits');
    }
}
