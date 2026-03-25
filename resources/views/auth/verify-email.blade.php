<x-guest-layout>
    <div class="pt-12 pb-8 px-4 sm:px-6">
        
        <div class="flex flex-col items-center text-center">
            <div class="mb-8 rounded-full bg-indigo-50 p-6 ring-8 ring-indigo-50/50">
                <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Verify your email</h2>
            <p class="mt-3 max-w-sm text-base text-gray-500 leading-relaxed">
                {{ __('We sent a verification link to your inbox. Please click it to activate your account and get started.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-8 p-4 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium text-emerald-800">
                    {{ __('A fresh link has been sent to your email.') }}
                </span>
            </div>
        @endif

        <div class="mt-10 space-y-4">
            @php
                $email = auth()->user()->email;
                $domain = substr(strrchr($email, "@"), 1);
                $mailUrls = [
                    'gmail.com' => 'https://mail.google.com',
                    'outlook.com' => 'https://outlook.live.com',
                    'yahoo.com' => 'https://mail.yahoo.com',
                ];
                $url = $mailUrls[$domain] ?? null;
            @endphp

            @if($url)
                <a href="{{ $url }}" target="_blank" class="w-full inline-flex justify-center items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white shadow-sm hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 transition-all duration-200">
                    Open {{ ucfirst(explode('.', $domain)[0]) }}
                </a>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                    {{ __('Resend verification email') }}
                </button>
            </form>
        </div>

        <div class="mt-12 pt-6 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
                @csrf
                <button type="submit" class="text-xs font-medium text-gray-400 hover:text-gray-600 uppercase tracking-widest transition-colors">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
