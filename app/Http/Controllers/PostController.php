<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
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
    public function edit($id){
        $resultado = DB::select('SELECT id , titulo , contenido FROM posts WHERE id = ?', [$id]);

        if(empty($resultado)){
            abort(404);
        }

        return view('posts.edit', ['post'=> $resultado[0]]);
    }

    public function update(Request $request, $id){
        $datos = $request->validate([
            'titulo'=> 'required|string|max:255',
            'contenido'=> 'required|string'
        ]);

        $fila = DB::update('UPDATE posts SET titulo = ? , contenido = ?, updated_at = GETDATE() where id = ?',
        [$datos['titulo'], $datos['contenido'], $id]);

        return redirect()->route('posts.show', $id)->with('exito', 'Nota actualizada correctamente.');
    }

    public function destrory($id){
        DB::delete('delete posts where id = ?', [$id]);

        return redirect()->route('posts.index')->with('exito', 'Nota eliminada correctamente.');
    }
}
