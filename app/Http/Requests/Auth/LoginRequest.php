<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer a solicitação.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtém as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'], // Campo de login que pode ser email ou CRM
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Autentica o usuário com base nas credenciais fornecidas.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        // Verifica se o campo de login é um email ou CRM
        $credentials = $this->only('login', 'password');
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'crm';

        // Tenta autenticar o usuário
        if (!Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Garante que a solicitação não esteja limitada por taxa.
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Obtém a chave de limitação de taxa para a solicitação.
     *
     * @return string
     */

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')).'|'.$this->ip());
    }
}
