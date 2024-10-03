<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Helpers\ErrorHandler;

class HomeController extends Controller
{
    protected $errorHandler;
    public function __construct(ErrorHandler $errorHandler){
        $this->errorHandler = $errorHandler;
    }

    public function show()
    {
        try{
            $categories = Category::select('id','title')->orderBy('created_at','desc')->limit(9)->get();
            $books = Book::select('id','title','book_image','price')->orderBy('created_at','desc')->limit(10)->get();
            $authors = Author::select('id','name','author_image')->orderBy('created_at','desc')->limit(10)->get();
            return view('index',['categories' => $categories,'books' => $books,'authors' => $authors]);
        }
        catch (Exception $e){
            return $this->errorHandler->handleException($e);
        }
    }
}
