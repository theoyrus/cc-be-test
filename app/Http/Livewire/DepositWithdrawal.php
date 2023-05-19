<?php

namespace App\Http\Livewire;

use App\Events\UpdateCustomerWalletJobDone;
use App\Jobs\UpdateCustomerWalletJob;
use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionService;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DepositWithdrawal extends Component
{
    public $orderId;
    public $amount;
    public $type;

    public $jobStatus;
    public $jobMessage;

    // protected $listeners = ['updateCustomerWalletJobDone' => 'handleJobFinished'];

    public function getListeners()
    {
        return [
            "echo-private:wallet-balance,UpdateCustomerWalletJobDone" => "handleJobFinished",
            UpdateCustomerWalletJobDone::class => 'handleJobFinished',
            'jobFinished' => 'flashJobFinished',
        ];
    }

    public function mount(Request $request)
    {
        $segments = $request->segments();
        $this->type = end($segments) == 'deposit' ? 'deposit' : 'withdraw';

        // random Order ID
        $this->orderId = Str::random(32);

        // $this->listeners['jobFinished'] = 'handleJobFinished';
    }

    public function render()
    {
        return view('livewire.deposit-withdrawal');
    }

    public function process()
    {
        $impersonatedUserId = session()->get('impersonated_user');
        if (!$impersonatedUserId) {
            return session()->flash('error', 'User tidak ditemukan');
        }

        $this->validate([
            'orderId' => 'required|string',
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        $customer = User::find($impersonatedUserId);
        if ($this->type == 'withdraw' and $customer->balance < $this->amount) {
            return session()->flash('error', 'Saldo tidak cukup');
        }

        $transactionService = new TransactionService();
        $response = $transactionService->processTransaction($this->orderId, $this->amount);

        if ($response['status'] == 1) {
            try {
                // Kirim job pembaruan balance ke antrian
                UpdateCustomerWalletJob::dispatch(
                    $this->type,
                    $impersonatedUserId,
                    $this->orderId,
                    $this->amount
                );

                $this->jobStatus = 'in_progress';
                $this->jobMessage = 'Transaksi sedang diproses';
                session()->flash('info', $this->jobMessage);

                $this->dispatchBrowserEvent('job-status', [
                    'jobStatus' => $this->jobStatus,
                    'jobMessage' => $this->jobMessage,
                ]);
            } catch (\Throwable $err) {
                $this->jobStatus = 'failed';
                $this->jobMessage = 'Gagal memproses transaksi';
                session()->flash('error', $this->jobMessage);
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Transaksi gagal');
        }
    }

    public function handleJobFinished(UpdateCustomerWalletJobDone $event)
    {
        Log::info('event terpanggil');

        $this->jobStatus = $event->status;
        $this->jobMessage = $event->message;

        if ($event->status === 'success') {
            session()->flash('success', $event->message);
        } else {
            session()->flash('error', $event->message);
        }
        return redirect()->route('transactions.index');
    }

    public function flashJobFinished()
    {
        session()->flash('success', 'Pembaruan balance berhasil');
        return redirect()->away(route('transactions.index'));
    }
}
