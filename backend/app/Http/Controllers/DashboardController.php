<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalBooks = Book::count();
            $totalLoans = Loan::count();
            $activeLoans = Loan::where('status', 'BORROWED')->count();

            return view('admin.dashboard', compact('totalBooks', 'totalLoans', 'activeLoans'));
        }

        $activeLoans = Loan::where('user_id', $user->id)
            ->where('status', 'BORROWED')
            ->count();

        return view('dashboard', compact('activeLoans'));
    }
}

