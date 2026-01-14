<?php

use App\Http\Controllers\Api\BookApiController;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/books', [BookApiController::class, 'index']);

Route::get('/demo/loans', function () {
    $user = User::where('email', 'user@example.com')->firstOrFail();

    $loans = Loan::with('book')
        ->where('user_id', $user->id)
        ->orderByDesc('borrow_date')
        ->get()
        ->map(function (Loan $loan) {
            return [
                'id' => $loan->id,
                'book_id' => $loan->book?->id,
                'book_title' => $loan->book?->title,
                'borrow_date' => $loan->borrow_date?->format('d-m-Y'),
                'return_deadline' => $loan->return_deadline?->format('d-m-Y'),
                'status' => $loan->status,
            ];
        });

    return response()->json($loans->values());
});

Route::post('/demo/books/{book}/loans', function (Book $book) {
    $user = User::where('email', 'user@example.com')->firstOrFail();

    if ($book->stock <= 0) {
        return response()->json([
            'message' => 'Stock buku habis.',
        ], 422);
    }

    $activeLoansCount = Loan::where('user_id', $user->id)
        ->where('status', 'BORROWED')
        ->count();

    if ($activeLoansCount >= 3) {
        return response()->json([
            'message' => 'Maksimal 3 buku aktif yang belum dikembalikan.',
        ], 422);
    }

    $loan = null;

    DB::transaction(function () use ($book, $user, &$loan) {
        $today = now()->toDateString();
        $deadline = now()->addDays(7)->toDateString();

        $loan = Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => $today,
            'return_deadline' => $deadline,
            'status' => 'BORROWED',
        ]);

        $book->decrement('stock');
    });

    return response()->json([
        'message' => 'Buku berhasil dipinjam.',
        'loan_id' => $loan?->id,
    ], 201);
});

Route::post('/demo/loans/{loan}/return', function (Loan $loan) {
    $user = User::where('email', 'user@example.com')->firstOrFail();

    if ($loan->user_id !== $user->id) {
        return response()->json([
            'message' => 'Tidak diizinkan mengembalikan peminjaman ini.',
        ], 403);
    }

    if ($loan->status === 'RETURNED') {
        return response()->json([
            'message' => 'Transaksi ini sudah dikembalikan.',
        ], 422);
    }

    DB::transaction(function () use ($loan) {
        $loan->update([
            'status' => 'RETURNED',
            'return_date' => now()->toDateString(),
        ]);

        $loan->book()->increment('stock');
    });

    return response()->json([
        'message' => 'Buku berhasil dikembalikan.',
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
