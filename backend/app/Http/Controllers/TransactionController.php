<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        $user = auth()->user();
        
        if (!$user->wallet) {
            return response()->json([
                'error' => 'User wallet not found'
            ], 404);
        }
    
        $transactions = Transaction::where('sender_id', $user->wallet->id)
            ->orWhere('receiver_id', $user->wallet->id)
            ->get();
    
        if ($transactions->isEmpty()) {
            return response()->json([
                'message' => 'No transactions found for this user'
            ]);
        }
    
        return response()->json([
            'transactions' => $transactions
        ]);
    }
    
}
