<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function deposit(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');

        if ($amount <= 0) {
            return response()->json([
                'message' => 'Invalid amount'
            ], 400);
        }

        $user->wallet->solde += $amount;
        $user->wallet->save();

        $transaction = Transaction::create([
            'sender_id' => $user->wallet->id,
            'receiver_id' => $user->wallet->id,
            'amount' => $amount,
            'type' => 'deposit'
        ]);

        return response()->json([
            'message' => 'Deposit successful',
            'solde' => $user->wallet->solde
        ]);
    }
}
