<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->orderByDesc('borrow_date')
            ->get();

        return view('loans.index', compact('loans'));
    }

    public function store(Request $request, Book $book)
    {
        $user = $request->user();

        if ($book->stock <= 0) {
            return back()->with('error', 'Stock buku habis.');
        }

        $activeLoansCount = Loan::where('user_id', $user->id)
            ->where('status', 'BORROWED')
            ->count();

        if ($activeLoansCount >= 3) {
            return back()->with('error', 'Maksimal 3 buku aktif yang belum dikembalikan.');
        }

        DB::transaction(function () use ($book, $user) {
            $today = now()->toDateString();
            $deadline = now()->addDays(7)->toDateString();

            Loan::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'borrow_date' => $today,
                'return_deadline' => $deadline,
                'status' => 'BORROWED',
            ]);

            $book->decrement('stock');
        });

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dipinjam.');
    }

    public function returnBook(Loan $loan)
    {
        $user = Auth::user();

        if ($loan->user_id !== $user->id && $user->role !== 'admin') {
            abort(403);
        }

        if ($loan->status === 'RETURNED') {
            return back()->with('error', 'Transaksi ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($loan) {
            $loan->update([
                'status' => 'RETURNED',
                'return_date' => now()->toDateString(),
            ]);

            $loan->book()->increment('stock');
        });

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan.');
    }
}

