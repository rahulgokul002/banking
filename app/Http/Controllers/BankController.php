<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function showDashboard()
{
    $userId = Auth::id();
    $balance=$this->calculateBalance($userId);
    return View::make('dashboard', ['balance' => $balance]);
}
    public function deposit(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $transaction = new Bank([
            'user_id' => auth()->user()->id,
            'details' => 'deposit',
            'amount' => $validatedData['amount'],
            'type' => 'Credit',
            'balance' => $this->calculateBalance(auth()->user()->id) + $validatedData['amount'],
        ]);

        $transaction->save();
        return redirect()->back()->with('success', 'Deposit transaction recorded successfully.');
    }

    public function withdrawamount(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
        $userBalance = $this->calculateBalance(auth()->user()->id);
        if ($userBalance < $validatedData['amount']) {
            return redirect()->back()->with('success', 'Insufficient balance.');
        }
        $transaction = new Bank([
            'user_id' => auth()->user()->id,
            'details' => 'withdraw',
            'amount' => $validatedData['amount'],
            'type' => 'Debit',
            'balance' => $userBalance - $validatedData['amount'],
        ]);

        $transaction->save();

        return redirect()->back()->with('success', 'Withdraw transaction recorded successfully.');
    }
    private function calculateBalance($userId)
    {
        // Retrieve the user's bank record
        $bank = Bank::where('user_id', $userId)->latest()->first();

        if ($bank) {
            return $bank->balance;
        }

        return 0;
    }


    public function transferamount(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'recipient_email' => 'required|email',
        ]);
    
        $recipient = User::where('email', $validatedData['recipient_email'])->first();
        if (!$recipient) {
            return redirect()->back()->with('success', 'Recipient does not exist.');
        }    
        $userBalance = $this->calculateBalance(auth()->user()->id);
        if ($userBalance < $validatedData['amount']) {
            return redirect()->back()->with('success', 'Insufficient balance.');
        }
        $senderTransaction = new Bank([
            'user_id' => auth()->user()->id,
            'details' => 'Transfer to '.$validatedData['recipient_email'],
            'amount' => $validatedData['amount'],
            'type' => 'Debit',
            'balance' => $userBalance - $validatedData['amount'],
            'related_user_id' => $recipient->id,
        ]);
    
        $senderTransaction->save();
        $recipientBalance = $this->calculateBalance($recipient->id);
        $recipientTransaction = new Bank([
            'user_id' => $recipient->id,
            'details' => 'Transfer from '.$validatedData['recipient_email'],
            'amount' => $validatedData['amount'],
            'type' => 'Credit',
            'balance' => $recipientBalance + $validatedData['amount'],
            'related_user_id' => auth()->user()->id,
        ]);
    
        $recipientTransaction->save();
        return redirect()->back()->with('success', 'Transfer transaction recorded successfully.');
    }
    public function showstatement()
    {
        $userId = Auth::id();
        $balance=$this->calculateBalance($userId);
        $transactions = Bank::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return View::make('statement', compact('balance', 'transactions'));
    }

}
