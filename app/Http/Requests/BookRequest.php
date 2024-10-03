<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:1000',
            'price' => 'required |numeric | min:0',
            'language' => 'required | in:english,arabic,spanish',
            'book_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        // create book
        if ($this->isMethod('POST')) {
            $rules['book_image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        // update book
        elseif($this->isMethod('PUT')) {
            $rules['book_image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';            
        }
        
        // if new author
        if ($this->filled(['name', 'biography', 'birthdate']) || $this->hasFile('author_image')) {
            $authorRequest = new AuthorRequest();
            $rules = array_merge($rules, $authorRequest->rules());
        } else {
            $rules['author_id'] = 'required|exists:authors,id';
        }

        // if new category
        if ($this->filled(['category'])){
            $categoryRequest = new CategoryRequest();
            $rules['category'] = $categoryRequest->rules()['title'];
        }
        else{
            $rules['category_id'] = 'required|exists:categories,id';
        }
        

        return $rules;
    }
}
