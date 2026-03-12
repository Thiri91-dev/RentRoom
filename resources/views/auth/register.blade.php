@extends('layouts.app')
@section('content')

    <div class="max-w-md mx-auto mt-8">
        <h1 class="text-3xl font-bold text-stone-800 mb-2 text-center">Create Account</h1>
        <p class="text-stone-500 mb-8 text-center">Join to list or browse rooms</p>

        <form method="POST" action="{{ route('register') }}"
            class="bg-white rounded-xl border border-stone-200 shadow-sm p-8 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- mobile_no — from your SQL member table -->
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">
                    Mobile Number <span class="text-stone-400 font-normal">(optional)</span>
                </label>
                <input type="tel" name="mobile_no" value="{{ old('mobile_no') }}" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Password</label>
                <input type="password" name="password" required minlength="6" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 outline-none">
            </div>

            <button type="submit"
                class="w-full bg-red-700 text-white py-3 rounded-lg font-bold hover:bg-red-800 transition">
                Create Account
            </button>

            <p class="text-center text-sm text-stone-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-red-700 font-bold hover:underline">Login</a>
            </p>
        </form>
    </div>

@endsection