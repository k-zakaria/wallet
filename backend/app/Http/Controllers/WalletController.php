<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

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

        $wallet = $user->wallet;

        if (!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = $user->id;
            $wallet->solde = 0;
            $wallet->save();
        }
        
        $wallet->solde += $amount;
        $ancianMantant = $wallet->solde - $amount;
        $wallet->save();
        
        $transaction = Transaction::create([
            'sender_id' => $wallet->id,
            'receiver_id' => $wallet->id,
            'amount' => $amount,
            'type' => 'versement'
        ]);

        return response()->json([
            'message' => 'versement successful',
            'first name' => $user->name,
            'last name' => $user->Last_name,
            'ancian mantant' => $ancianMantant,
            'solde' => $wallet->solde
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

        $wallet = $user->wallet;

        if (!$wallet || $wallet->solde < $amount) {
            return response()->json([
                'message' => 'Insufficient solde'
            ], 400);
        }

        $wallet->solde -= $amount;
        $wallet->save();

        $transaction = Transaction::create([
            'sender_id' => $wallet->id,
            'receiver_id' => $wallet->id,
            'amount' => $amount,
            'type' => 'retrait'
        ]);

        return response()->json([
            'message' => 'retrait successful',
            'name' => $user->name,
            'solde' => $wallet->solde
        ]);
    }

    public function transfer(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');
        $wallet_id = $request->input('recipient_id');
        $wallet = Wallet::find($wallet_id);

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

        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found'
            ], 404);
        }

        $user->wallet->solde -= $amount;
        $user->wallet->save();

        $wallet->solde += $amount;
        $wallet->save();

        $transaction = Transaction::create([
            'sender_id' => $user->wallet->id,
            'receiver_id' => $wallet->id,
            'amount' => $amount,
            'type' => 'transfer'
        ]);

        return response()->json([
            'message' => 'Transfer successful',
            'solde' => $user->wallet->solde
        ]);
    }
}
