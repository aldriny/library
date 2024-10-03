<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Helpers\ErrorHandler;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Storage;
use Exception;

class AuthorController extends Controller
{

    protected $errorHandler;
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }
    
    public function index()
    {
        try{
            $authors = Author::orderBy('created_at','desc')->paginate(12);
            return view('author.index',['authors' => $authors]);
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error fetching authors.');
        }

    }

    public function showCreate()
    {
        return view('author.create');
    }

    public function create(AuthorRequest $request)
    {
        try{
            $validatedData = $request->validated();
            $validatedData['author_image'] = Storage::putFile('authors',$request->author_image);
            Author::create($validatedData);
            return redirect()->route('authors')->with('success', 'Author created successfully.');
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error creating author.');
        }

    }

    public function show($id)
    {
        try{
            $author = Author::findOrFail($id);
            $books = $author->books()->paginate(4);
            return view('author.show',['author' => $author,'books' => $books]);
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error fetching author.');
        }

    }

    public function showEdit($id)
    {
        try{
            $author = Author::find($id);
            return view('author.edit',['author' => $author]);
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error fetching author.');
        }
    }

    public function edit(AuthorRequest $request, $id)
    {
        try{
            $validatedData = $request->validated();
            $author = Author::findOrFail($id);
            if($request->author_image){
                Storage::delete($author->author_image);
                $validatedData['author_image'] = Storage::putFile('authors',$request->author_image);
            }
            $author->update($validatedData);
            return redirect()->route('authors')->with('success', 'Author updated successfully.');
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error updating author.');
        }

    }
    
    public function delete($id)
    {
        try{
            $author = Author::findOrFail($id);
            Storage::delete($author->author_image);
            $author->delete();
            return redirect()->route('authors')->with('success', 'Author deleted successfully.');
        }
        catch(Exception $e){
            return $this->errorHandler->handleException($e,'Error deleting author.');
        }
    }
}


