<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::with(['category', 'user'])
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%')
                      ->orWhere('type', 'like', '%' . $search . '%')
                      ->orWhereHas('category', function ($q) use ($search) {
                          $q->where('name', 'like', '%' . $search . '%');
                  });
        })
        ->get();

        return view('books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:book,pdf',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->type == 'pdf' && !$request->hasFile('file')) {
            return back()->withErrors(['file' => 'PDF file is required when type is pdf.'])->withInput();
        }

            $imagePath = null;
            $filePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books/images', 'public');
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('books/files', 'public');
        }


        Book::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status,
            'image' => $imagePath,
            'file' => $filePath,
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['category', 'user'])->findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id != Auth::id()) {
            abort(403);
        }

        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:book,pdf',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        $book = Book::findOrFail($id);

        if ($book->user_id != Auth::id()) {
            abort(403);
        }

        if ($request->type == 'pdf' && !$request->hasFile('file') && !$book->file) {
            return back()->withErrors(['file' => 'PDF file is required when type is pdf.'])->withInput();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books/images', 'public');
            $book->image = $imagePath;
        }

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('books/files', 'public');
            $book->file = $filePath;
        }

        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->type = $request->type;
        $book->status = $request->status;
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book->user_id != Auth::id()) {
            abort(403);
        }

        $book->delete();

        return redirect()->route('books.index');
    }

    public function myBooks()
    {
        $books = Book::with('category')
            ->where('user_id', Auth::id())
            ->get();

        return view('books.my_books', compact('books'));
    }
}
