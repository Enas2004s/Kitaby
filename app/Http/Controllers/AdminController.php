<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\BookRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $books = Book::count();
        $categories = Category::count();
        $requests = BookRequest::count();

        return view('admin.dashboard', compact('users', 'books', 'categories', 'requests'));
    }
}
