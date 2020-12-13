<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return view('article.showPetshop', compact('article'));
    }

    public function showPetowner(Article $article)
    {
        return view('article.showPetowner', compact('article'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => ['required', 'max:50'],
                'ulasan' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'judul.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'judul.max' => 'Maksimal 50 karakter',
                'ulasan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                // 'gambar.required' => 'Data tidak boleh kosong'
            ]
        );
        $attr = $request->all();
        $slug = \Str::slug(request('judul'));
        $attr['slug'] = $slug;

        if (request()->file('image')) {
            $gambar = request()->file('image')->store("images/artikel", "public");
        } else {
            $gambar = null;
        }

        $attr['tanggal'] = Carbon::now();

        $attr['gambar'] = $gambar;

        auth()->user()->article()->create($attr);

        session()->flash('success', 'Artikel berhasil dibuat.');

        return redirect()->route('index.article.admin');
    }

    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate(
            [
                'judul' => ['required', 'max:50'],
                'ulasan' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'judul.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'judul.max' => 'Maksimal 50 karakter',
                'ulasan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                // 'gambar.required' => 'Data tidak boleh kosong'
            ]
        );

        if (request()->file('image')) {
            \Storage::delete($article->thumbnail);
            $thumbnail = request()->file('image')->store("images/artikel", 'public');
        } else {
            $thumbnail = $article->thumbnail;
        }


        $attr = $request->all();
        $attr['user_id'] = auth()->id();
        $attr['gambar'] = $thumbnail;

        $article->update($attr);

        session()->flash('success', 'Artikel berhasil diubah.');

        return redirect()->route('index.article.admin');
    }

    public function destroy(Article $article)
    {
        \Storage::delete($article->gambar);
        $article->delete();
        session()->flash('success', 'Artikel Berhasil di hapus.');
        return redirect()->route('index.article.admin');
    }
}
