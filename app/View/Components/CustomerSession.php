<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class CustomerSession extends Component
{

    protected $impersonatedUserId;
    protected $impersonatedUser;

    /**
     * Create a new component instance.
     */
    public function __construct(Request $request)
    {
        $this->impersonatedUserId = $request->session()->get('impersonated_user');
        $this->impersonatedUser = User::find($this->impersonatedUserId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $impersonatedUser = $this->impersonatedUser;
        return view('components.customer-session', compact('impersonatedUser'));
    }
}
