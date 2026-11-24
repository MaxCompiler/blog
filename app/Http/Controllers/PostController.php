<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index(){
        $posts = DB::table('posts')
            ->select('id' , 'title', 'content', 'created_at')
            ->orderByDesc('id')
            ->get();
        
        return view('posts.index', ['posts' => $posts]);

    }

    public function show($id){
        $post = DB::table('posts')->where('id', $id)->first();

        abort_if(is_null($post), 404);

        return view('posts.show', ['post'=> $post]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'=> 'required|string|max:255',
            'content' => 'required|string'
        ]);

        try{
            DB::table('posts')->insert([
                'title' => $data['title'],
                'content' => $data['content'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
        }catch(QueryException $e){
            Log::error("El error esta en : ". $e->getMessage());

            return back()
                ->withInput()->with('error', 'No se pudo guardar la nota. Intenta de nuevo.');
        }

        return redirect()->route('posts.index')->with('exito', 'Nota creada correctamente.');
        
    }


    public function edit($id){
        $post = DB::table('posts')->where('id',$id)->first();

        abort_if(is_null($post), 404);

        return view('posts.edit', ['post'=> $post]);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'title'=> 'required|string|max:255',
            'content'=> 'required|string'
        ]);

        try{
            DB::table('posts')->where('id', $id)->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'created_at' => now(),
            ]);
        }catch(QueryException $e){
            Log::error('El error esta en: '. $e->getMessage());

            return back()->withInput()->with('error', 'No se pudo actualizar la nota.');
        }

        return redirect()->route('posts.show', $id)->with('exito', 'Nota actualizada correctamente.');
    }

    public function destroy($id){

        try{
            DB::table('posts')->where('id', $id)->delete();

        }catch(QueryException $e){
            Log::error('El error esta en: '. $e->getMessage());

            return back()->with('error','No se pudo eliminar la nota.');
        }

        return redirect()->route('posts.index')->with('exito', 'Nota eliminada correctamente.');
    }
}
