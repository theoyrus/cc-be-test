<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($jobStatus === 'in_progress')
        <div class="alert alert-info">{{ $jobMessage }}</div>
    @elseif ($jobStatus === 'failed')
        <div class="alert alert-danger">{{ $jobMessage }}</div>
    @endif

    <form wire:submit.prevent="process">
        <input type="hidden" wire:model="type" id="type" />
        <div class="form-group">
            <label for="order_id">Order ID</label>
            <input wire:model="orderId" type="text" class="form-control" id="order_id" />
            @error('orderId')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input wire:model="amount" type="text" class="form-control" id="amount" />
            @error('amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Process</button>
    </form>
</div>

<script>
    window.addEventListener('job-status', event => {
        console.log(event)
        // window.location.href = '/transactions';
        Livewire.emit('jobFinished')
    })
</script>
