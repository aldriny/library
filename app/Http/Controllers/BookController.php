<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorHandler;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class BookController extends Controller
{

    protected $errorHandler;
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function index()
    {
        try {
            $books = Book::orderBy('created_at', 'desc')->paginate(12);
            return view('book.index', ['books' => $books]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching books');
        }
    }

    public function showCreate()
    {
        try {
            $categories = Category::all();
            $authors = Author::all();
            return view('book.create', [
                'categories' => $categories,
                'authors' => $authors
            ]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e);
        }
    }

    public function create(BookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // if new author or category are added
            $this->addAuthorAndCategory($request, $validatedData);


            $validatedData['book_image'] = Storage::putFile('books', $request->book_image);
            Book::create($validatedData);

            return redirect()->route('books')->with('success', 'Book added successfully');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error creating book');
        }
    }

    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return view('book.show', ['book' => $book]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching book');
        }
    }


    public function showEdit($id)
    {
        try {
            $book = Book::findOrFail($id);
            $categories = Category::all();
            $authors = Author::all();
            return view('book.edit', ['book' => $book, 'categories' => $categories, 'authors' => $authors]);
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching book.');
        }
    }

    public function edit(BookRequest $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $validatedData = $request->validated();
            // if new author or category are added
            $this->addAuthorAndCategory($request, $validatedData);

            // if book image is updated
            if ($request->book_image) {
                Storage::delete($book->book_image);
                $validatedData['book_image'] = Storage::putFile('books', $request->book_image);
            }
            $book->update($validatedData);
            return redirect()->route('showBook', ['id' => $book->id])->with('success', 'Book updated successfully');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error updating book.');
        }
    }


    public function delete($id)
    {
        try {
            $book = Book::findOrFail($id);
            Storage::delete($book->book_image);
            $book->delete();
            return redirect()->route('books')->with('success', 'Book deleted successfully');
        } catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error deleting book.');
        }
    }


    private function addAuthorAndCategory(Request $request, array &$validatedData)
    {
        // Handle new author creation
        if ($request->filled(['name', 'biography', 'birthdate']) && $request->hasFile('author_image')) {
            $authorData = $request->only(['name', 'biography', 'birthdate', 'author_image']);
            $authorData['author_image'] = Storage::putFile('authors', $request->file('author_image'));
            $newAuthor = Author::create($authorData);
            $validatedData['author_id'] = $newAuthor->id;
        }

        // Handle new category creation
        if ($request->filled(['category'])) {
            $categoryData['title'] = $request->category;
            $newCategory = Category::create($categoryData);
            $validatedData['category_id'] = $newCategory->id;
        }
    }
}
