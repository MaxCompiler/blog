<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    public function index(){
        $posts = DB::select('SELECT id, titulo , contenido, created_at FROM posts ORDER BY id DESC');
        
        return view('posts.index', ['posts' => $posts]);

    }

    public function show($id){
        $posts = DB::select('SELECT id , titulo , contenido , created_at FROM posts WHERE id = ?',[$id]);
        if(empty($posts)){
            abort(404);
        }
        return view('posts.show', ['post'=> $posts[0]]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $datos = $request->validate([
            'titulo'=> 'required|string|max:255',
            'contenido' => 'required|string'
        ]);
        DB::insert(
            'INSERT INTO posts (titulo , contenido , created_at , updated_at)
            VALUES (?,?,GETDATE(), GETDATE())',[$datos['titulo'], $datos['contenido']]);
        
        return redirect()->route('posts.index')->with('exito', 'Nota creada correctamente.');

    }
}
