<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('account', compact('user'));
    }

    public function showDepositForm()
    {
        return view('add_deposit');
    }

    public function deposit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Update user's account balance
        $user = Auth::user();
        
        $user->balance += $request->input('amount');
        $user->save();

        // Record the deposit transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->input('amount'),
            'type' => 'deposit',
        ]);

        return redirect()->route('deposit.form')->with('success', 'Deposit successful!');
    }

    public function showWithdrawalForm()
    {
        return view('withdrawal');
    }

    public function withdrawal(Request $request)
    {
        // Validate the form data
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . Auth::user()->balance,
        ]);

        // Update user's account balance
        $user = Auth::user();
        $user->balance -= $request->input('amount');
        $user->save();

        // Record the withdrawal transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->input('amount'),
            'type' => 'withdrawal',
        ]);

        return redirect()->route('withdrawal.form')->with('success', 'Withdrawal successful!');
    }

    public function showTransferForm()
    {
        return view('transfer');
    }

    public function transfer(Request $request)
    {
        // Validate the form data
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . Auth::user()->balance,
            'email' => 'required|email|exists:users,email',
        ]);

        // Update user's account balance
        $user = Auth::user();
        $user->balance -= $request->input('amount');
        $user->save();

        // Record the transfer transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->input('amount'),
            'type' => 'transfer',
            'recipient_email' => $request->input('email'),
        ]);

        // Update recipient's account balance
        $recipient = User::where('email', $request->input('email'))->first();
        $recipient->balance += $request->input('amount');
        $recipient->save();

        return redirect()->route('transfer.form')->with('success', 'Transfer successful!');
    }

    public function showStatement()
    {
        $user = Auth::user();
       
        $transactions = Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(3);
        return view('transactions', compact('transactions','user'));
    }
}
