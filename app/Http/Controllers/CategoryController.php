<?php

// This controller handles the category-related views in the application.
// It includes methods to display the index, show a specific category, create a new category, and edit an existing category.
// Each method returns a view corresponding to the action, passing any necessary data (like the category ID) to the view.

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    private function findPost($id){
        return Post::findOrFail($id); // Helper method to find a post by ID or fail if not found
    }

    public function getCategories()
    {
        $categories = Category::all(); // Fetch all categories to display in the index view
        return view('components.own.header', compact('categories'));
    }
    public function getCategory($id)
    {
        $category = Category::findOrFail($id); // Fetch the category by ID, or fail if not found
        return view('category.show', compact('category'));
    }
    public function getIndex()
    {
        $posts = Post::all(); // Fetch all posts to display in the index view
        return view('category.index',compact('posts'));
    }

    public function getShow($id)
    {
        $post = $this->findPost($id); // Fetch the post by ID, or fail if not found
        return view('category.show', compact('post'));
    }

    public function getCreate()
    {
        return view('category.create');
    }

    public function getEdit($id)
    {
        $post = $this->findPost($id);
        return view('category.edit', compact('post'));
    }
}
