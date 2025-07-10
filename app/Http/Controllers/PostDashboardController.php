<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class PostDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::latest()->where('author_id', Auth::user()->id);


        if(request('keyword')){

            $posts->where('title', 'like', '%' . request('keyword') . '%');
        }


        return view('dashboard.index', ['posts'=> $posts->paginate(7)->withQueryString() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    
    public function store(Request $request)
    {


    Validator::make($request->all(), [
        'title' =>'required|unique:posts|min:4|max:255',
        'category_id' => 'required',
        'body' => 'required|min:20',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

    ], [
        'title.required' => 'Field :attribute  harus diisi!',
        'category_id.required' => 'Pilih salah satu kategori!',
        'body.required' => ':attribute tidak boleh kosong!',
        'body.min' => ':attribute harus :min karakter atau lebih!',
        'thumbnail.image' => 'File harus berupa gambar!',
        'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg!',
        'thumbnail.max' => 'Ukuran gambar maksimal 2MB!'
    ],[

        'title' =>'Judul',
        'category_id' => 'Kategori',
        'body' => 'Tulisan',
        'thumbnail' => 'Gambar Utama',
    ]
    
    )->validate();

      $thumbnailPath = null;
      if ($request->hasFile('thumbnail')) {
          $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
      }

       Post::create([
        'title' => $request->title,
        'author_id' => Auth::user()->id,
        'category_id' => $request->category_id,
        'slug' => Str::slug($request->title),
        'body' => $request->body
        ,'thumbnail' => $thumbnailPath

       ]);
       return redirect('/dashboard')->with(['success' =>'Your post has been saved!']);
    }


    public function show(Post $post)
    {
        return view ('dashboard.show', ['post' => $post]);
    }

 
    public function edit(Post $post)
    {
        return view('dashboard.edit', ['post' => $post]);
    }

   
    public function update(Request $request, Post $post)
    {
  
   
      $request->validate([
            'title' =>'required|min:4|max:255|unique:posts,title' . $post->id,
            'category_id' => 'required',
            'body' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      $data = [
        'title' => $request->title,
        'author_id' => Auth::user()->id,
        'category_id' => $request->category_id,
        'slug' => Str::slug($request->title),
        'body' => $request->body
      ];
      if ($request->hasFile('thumbnail')) {
          $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
      }
      $post->update($data);


        return redirect('/dashboard')->with(['success' =>'Your post has been updated!']);
    }


    public function destroy(Post $post)
    {
       $post->delete();
       return redirect('/dashboard')->with(['success' =>'Your post has been removed!']);
    }
}
