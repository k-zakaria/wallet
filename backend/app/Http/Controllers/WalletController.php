<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
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


    public function retrait(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');

        if ($amount <= 0) {
            return response()->json([
                'message' => 'Invalid amount'
            ], 400);
        }

        if ($user->wallet->solde < $amount) {
            return response()->json([
                'message' => 'Insufficient solde'
            ], 400);
        }

        $user->wallet->solde -= $amount;
        $user->wallet->save();

        $transaction = Transaction::create([
            'sender_id' => $user->wallet->id,
            'receiver_id' => $user->wallet->id,
            'amount' => $amount,
            'type' => 'retrait'
        ]);

        return response()->json([
            'message' => 'retrait successful',
            'solde' => $user->wallet->solde
        ]);
    }


    
}
