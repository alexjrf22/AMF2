<?php

namespace App\Controllers;
use ALEX\Controller;
use App\Models\User;
use App\Models\Product;

class UsersController extends Controller
{
    public function index()
    {
        $this->model;
        $this->render(['nome' => $_GET['nome']], 'users/index');
    }

    public function create()
    {
        echo 'página de registro';
    }
}