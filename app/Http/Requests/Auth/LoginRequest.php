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
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'captcha' => ['required', 'string', function ($attribute, $value, $fail) {
                $expected = session('captcha_answer');
                $expiresAt = session('captcha_expires_at');

                // Always invalidate captcha immediately (single-use) to prevent replay attacks
                session()->forget(['captcha_answer', 'captcha_expires_at']);

                if (!$expected || !$expiresAt || now()->timestamp > (int) $expiresAt) {
                    $fail('Kode verifikasi (captcha) telah kedaluwarsa. Silakan muat ulang captcha.');
                    return;
                }

                if (!hash_equals((string) $expected, strtolower(trim((string) $value)))) {
                    $fail('Kode verifikasi (captcha) tidak benar.');
                }
            }],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            try {
                \App\Models\SecurityLog::create([
                    'incident_id' => strtoupper(substr(hash('sha256', $this->ip() . microtime(true)), 0, 12)),
                    'ip_address' => $this->ip() ?? 'unknown',
                    'threat_type' => 'Failed Login Attempt',
                    'severity' => 'medium',
                    'method' => $this->method(),
                    'url' => $this->fullUrl(),
                    'user_agent' => mb_substr((string) $this->userAgent(), 0, 500),
                    'reason' => 'Failed login for email: ' . $this->string('email'),
                    'action_taken' => 'monitored',
                ]);
            } catch (\Throwable $e) {}

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if (Auth::user()->status !== 'active') {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda sedang dinonaktifkan. Hubungi administrator.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        try {
            \App\Models\SecurityLog::create([
                'incident_id' => strtoupper(substr(hash('sha256', $this->ip() . microtime(true)), 0, 12)),
                'ip_address' => $this->ip() ?? 'unknown',
                'threat_type' => 'Brute Force Attack',
                'severity' => 'high',
                'method' => $this->method(),
                'url' => $this->fullUrl(),
                'user_agent' => mb_substr((string) $this->userAgent(), 0, 500),
                'reason' => 'Login rate limit exceeded for email: ' . $this->string('email'),
                'action_taken' => 'throttled',
            ]);
        } catch (\Throwable $e) {}

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
