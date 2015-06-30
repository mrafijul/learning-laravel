<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;
use Illuminate\httpResponse;
use App\Http\Controllers\Controller;
use Auth;

class ArticlesController extends Controller
{
    //
    public function index() {
    
    $articles = Article::latest('published_at')->published()->get();
 
    return view('article.index',compact('articles'));
}
	public function show($id) {
		$article=Article::findOrFail($id); 

		return view('article.show',compact('article'));

	}

	public function create(){
		return view('article.create');
	}    

	public function store(ArticleRequest $request){
 		$article = new Article($request->all());
 		Auth::user()->articles()->save($article);
 		//Article::create($request->all());

		return redirect('articles');
	} 

	public function edit($id){
		$article = Article::findOrFail($id);
		return view('article.edit',compact('article'));
	}
	public function update($id,ArticleRequest $request){
		$article = Article::findOrFail($id);

		$article->update($request->all());

		return redirect ('articles');

	}
}
