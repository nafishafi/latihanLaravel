<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['name' => 'Muhammad Nafis Hafi', 'title' => 'About']);
});

Route::get('/posts', function () {
    // $posts = Post::with(['author', 'category'])->latest()->get();

    return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(10)->withQueryString()]);
});

Route::get('/posts/{post:slug}', function (Post $post){
    // $post = Post::find($slug);
        
    return view('post', ['title' => 'Single Post', 'post' => $post]);
   
});

Route::get('/authors/{user:username}', function (User $user){
    // $post = Post::find($slug);
    // $posts = $user->posts->load('category', 'author');
        
    return view('posts', ['title' => count($user->posts).' Article by ' . $user->name, 'posts' => $user->posts]);
   
});

Route::get('/categories/{category:slug}', function (Category $category){
    // $post = Post::find($slug);
    // $posts = $category->posts->load('category', 'author');

        
    return view('posts', ['title' => 'Articles in: ' . $category->name, 'posts' => $category->posts]);
   
});

Route::get('/contact', function () {
    return view('contact',  ['title' => 'Contact']);
});
