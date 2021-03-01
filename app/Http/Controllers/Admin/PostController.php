<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $postValidation = [
        'title' => 'required|max:100',
        'body' => 'required',
        'img_path' => 'image',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        // $posts = Post::all();


        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request -> validate($this -> postValidation);

        $newPost = new Post;

        // GENERO I DATI MANCANTI AUTOMATICAMENTE
        // SLUG PRESO DAL NOME
        $data['slug'] = Str::slug($data['title']);
        // ID PRESO DALL'UTENTE LOGGATO
        $data['user_id'] = Auth::id();
        // SALVO IMG CARICATA DALL'UTENTE
        if (!empty($data['img_path'])) {
            $data['img_path'] = Storage::disk('public')->put('images', $data['img_path']);
        }


        $newPost->fill($data); //SETTARE IL FILLABLE NEL MODEL
        // dd($newPost);
        // SALAVATAGGIO
        $newPost->save();

        return redirect()->route('admin.posts.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::where('slug', $slug)->firstOrFail();
        // dd($post);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        // SLUG SOVRASCITTO DAL NUOVO TITOLO
        $data['slug'] = Str::slug($data['title']);
        // SOVRASCRIVO SE NECESSARIO IMG
        if (!empty($data['img_path'])) {
            $data['img_path'] = Storage::disk('public')->put('images', $data['img_path']);
        }

        // FACCIO LA VALIDAZIONE
        $request->validate($this->postValidation);

        $post->update($data);

        // dd($post);

        return redirect()
            ->route('admin.posts.index')
            ->with('message', 'Post ' . $post->title . 'aggiornato correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('message', 'Post ' . $post->title . 'cancellato correttamente!');
    }
}
