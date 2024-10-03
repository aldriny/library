<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorHandler;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    protected $errorHandler;
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    public function index()
    {
        try {
            $categories = Category::orderBy('created_at', 'desc')->paginate(12);
            return view('category.index', ['categories' => $categories]);
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching categories.');
        }
    }

    public function showCreate()
    {
        return view('category.create');
    }

    public function create(CategoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Category::create($validatedData);
            return redirect()->route('categories')->with('success', 'Category created successfully.');
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error creating category.');
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            $books = $category->books()->paginate(2);
            return view('category.show', ['category' => $category, 'books' => $books]);
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching category.');
        }
    }

    public function showEdit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('category.edit', ['category' => $category]);
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error fetching category.');
        }
    }

    public function edit(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $validatedData = $request->validated();
            $category->update($validatedData);
            return redirect()->route('categories')->with('success', 'Category updated successfully.');
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error updating category.');
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('categories')->with('success', 'Category deleted successfully.');
        }
        catch (Exception $e) {
            return $this->errorHandler->handleException($e, 'Error deletinf category.');
        }
    }

}
