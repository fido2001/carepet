<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function indexAdmin()
    {
        return view('article.indexAdmin', [
            'article' => Article::latest()->paginate(6),
        ]);
    }
    
    public function indexPetshop()
    {
        return view('article.indexPetshop', [
            'article' => Article::latest()->paginate(6),
        ]);
    }
    
    public function indexPetowner()
    {
        return view('article.indexPetowner', [
            'article' => Article::latest()->paginate(6),
        ]);
    }

    public function showAdmin(Article $article)
    {
        return view('article.showAdmin', compact('article'));
    }

    public function showPetshop(Article $article)
    {

    }
    
    public function showPetowner(Article $article)
    {

    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'ulasan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $attr = $request->all();
        $slug = \Str::slug(request('judul'));
        $attr['slug'] = $slug;

        if (request()->file('image')) {
            $gambar = request()->file('image')->store("images/artikel", "public");
        } else {
            $gambar = null;
        }

        $attr['gambar'] = $gambar;

        auth()->user()->article()->create($attr);

        session()->flash('success', 'Artikel berhasil dibuat.');

        return redirect()->route('index.article.admin');
    }

    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }
}
