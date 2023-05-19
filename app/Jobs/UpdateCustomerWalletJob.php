<?php

namespace App\Jobs;

use App\Events\UpdateCustomerWalletJobDone;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateCustomerWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type;
    protected $userId;
    protected $orderId;
    protected $amount;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type, int $userId, string $orderId, float $amount)
    {
        $this->type = $type;
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->amount = $amount;
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [(new WithoutOverlapping($this->orderId))->releaseAfter(60)];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $transaction = new Transaction();
            $transaction->user_id = $this->userId;
            $transaction->order_id = $this->orderId;
            $transaction->amount = $this->amount;
            $transaction->type = $this->type;
            $transaction->save();

            $customer = User::find($this->userId);
            if ($this->type == 'deposit') {
                $customer->deposit($this->amount);
            } elseif ($this->type == 'withdraw') {
                $customer->withdraw($this->amount);
            }
            $customer->save();

            Log::info('Pembaruan balance berhasil');

            // Kirim event ke komponen Livewire
            $message = 'Pembaruan balance berhasil';

            event(new UpdateCustomerWalletJobDone('success', $message));
        } catch (\Throwable $e) {
            Log::error('Pembaruan balance gagal: ' . $e->getMessage());

            // Kirim event ke komponen Livewire
            $message = 'Gagal memperbarui balance';
            event(new UpdateCustomerWalletJobDone('failed', $message));

            // Lempar pengecualian untuk menandakan kegagalan pembaruan balance
            throw $e;
        }
    }
}
