<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';
    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:' . User::class],
        ]);
        // format the kenyan contact to start with +254
        if (preg_match('/^0[0-9]{9}$/', $validated['phone'])) {
            $validated['phone'] = '+254' . substr($validated['phone'], 1);
        } elseif (preg_match('/^[0-9]{9}$/', $validated['phone'])) {
            $validated['phone'] = '+254' . $validated['phone'];
        }elseif (preg_match('/^254[0-9]{9}$/', $validated['phone'])) {
            $validated['phone'] = '+' . $validated['phone'];
        }elseif (preg_match('/^\+[0-9]{3}[0-9]{9}$/', $validated['phone'])) {
            $validated['phone'] = ''.$validated['phone'];
        } else {
            $this->addError('phone', 'Invalid phone number');
            return;
        }
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register2(): void
    {
        $validated = $this->validate([
            
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Session::regenerate();

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
