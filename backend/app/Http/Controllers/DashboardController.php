<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Category;
use App\Models\User;
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
            $totalCategories = Category::count();
            $totalUsers = User::where('role', 'user')->count();
            $returnedLoans = Loan::where('status', 'RETURNED')->count();
            $recentLoans = Loan::with(['user', 'book'])->latest()->limit(5)->get();

            return view('admin.dashboard', compact(
                'totalBooks',
                'totalLoans',
                'activeLoans',
                'totalCategories',
                'totalUsers',
                'returnedLoans',
                'recentLoans'
            ));
        }

        $activeLoans = Loan::where('user_id', $user->id)
            ->where('status', 'BORROWED')
            ->count();

        return view('dashboard', compact('activeLoans'));
    }
}
