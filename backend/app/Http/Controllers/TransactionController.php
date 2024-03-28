<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions()
    {
        $user = auth()->user();
        $transactions = Transaction::where('sender_id', $user->wallet->id)->orWhere('receiver_id', $user->wallet->id)->get();

        return response()->json([
            'transactions' => $transactions
        ]);
    }   
}
