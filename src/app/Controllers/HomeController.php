<?php 

namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller{
    public function index($request, $response){
        // $users = $this->db->table('users')->get();
        $user = User::create([
            'name' => "Etty Eindyastuti",
            'email' => "etty.windyastuti@gmail.com",
            'password' => "123"
        ]);
        die( var_dump($user->name) );
        return $this->view->render($response, 'index.twig');
    }
}