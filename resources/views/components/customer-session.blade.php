<div>
    @if ($impersonatedUser)
        Hi, {{ $impersonatedUser->name }},
        Balance: {{ number_format($impersonatedUser->balance, 2, ',', '.') }}
    @endif
</div>
