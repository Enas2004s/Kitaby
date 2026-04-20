<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requests = BookRequest::with(['book', 'user'])
            ->whereHas('book', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('book_requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->user_id == Auth::id()) {
            return back()->withErrors([
                'book_id' => 'You cannot request your own book.',
            ]);
        }

        BookRequest::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->back();
    }


    public function approve($id)
    {
        $request = BookRequest::where('id', $id)
            ->whereHas('book', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $request->status = 'approved';
        $request->save();

        return redirect()->back();
    }

    public function reject($id)
    {
        $request = BookRequest::where('id', $id)
            ->whereHas('book', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $request->status = 'rejected';
        $request->save();

        return redirect()->back();
    }

    public function myRequests()
    {
        $requests = BookRequest::with('book')
            ->where('user_id', Auth::id())
            ->get();

        return view('book_requests.my_requests', compact('requests'));
    }

    /**
     * Display the specified resource.
     */
    public function show(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookRequest $bookRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookRequest $bookRequest)
    {
        //
    }
}
