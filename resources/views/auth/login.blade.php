@extends('layouts.app')
@section('content')

    <div class="max-w-md mx-auto mt-8">
        <h1 class="text-3xl font-bold text-stone-800 mb-8 text-center">Welcome Back</h1>

        <form method="POST" action="{{ route('login') }}"
            class="bg-white rounded-xl border border-stone-200 shadow-sm p-8 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
            </div>

            <button type="submit"
                class="w-full bg-red-700 text-white py-3 rounded-lg font-bold hover:bg-red-800 transition">
                Login
            </button>

            <p class="text-center text-sm text-stone-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-red-700 font-bold hover:underline">Register</a>
            </p>
        </form>
    </div>

@endsection