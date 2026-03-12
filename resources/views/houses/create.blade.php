@extends('layouts.app')
@section('content')

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-stone-800 mb-2">List a Room</h1>
        <p class="text-stone-500 mb-8">Fill in the details below to post your room listing.</p>

        <form method="POST" action="{{ route('houses.store') }}"
            class="bg-white rounded-xl border border-stone-200 shadow-sm p-8 space-y-6">
            @csrf

            <!-- Address -->
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Address <span
                        class="text-red-600">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}" maxlength="100"
                    placeholder="e.g. 123 Main Street, Yangon" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                        focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none">
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Fee + Room Type (2 columns on tablet+) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">Monthly Fee ($) <span
                            class="text-red-600">*</span></label>
                    <input type="number" name="fee" value="{{ old('fee', 0) }}" min="0" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                          focus:ring-2 focus:ring-red-600 outline-none">
                    @error('fee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">Room Type <span
                            class="text-red-600">*</span></label>
                    <select name="roomtype" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                           focus:ring-2 focus:ring-red-600 outline-none">
                        <option value="Single Room">Single Room</option>
                        <option value="Shared Room">Shared Room</option>
                        <option value="Studio">Studio</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">Whole House</option>
                    </select>
                </div>
            </div>

            <!-- Gender + Availability -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">Gender Preference</label>
                    <select name="gender" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                           focus:ring-2 focus:ring-red-600 outline-none">
                        <!-- These map to: gender 0, 1, 2 in your SQL -->
                        <option value="0">Any Gender</option>
                        <option value="1">Male Only</option>
                        <option value="2">Female Only</option>
                    </select>
                </div>
                <div>
                    <!-- no_avaliablity — keeping your original field name -->
                    <label class="block text-sm font-bold text-stone-700 mb-1">Rooms Available</label>
                    <input type="number" name="no_avaliablity" value="{{ old('no_avaliablity', 1) }}" min="0" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                          focus:ring-2 focus:ring-red-600 outline-none">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Description</label>
                <textarea name="description" rows="4" placeholder="Describe the room, facilities, location..." class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                           focus:ring-2 focus:ring-red-600 outline-none resize-none">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-red-700 text-white py-3 rounded-lg font-bold text-base
                       hover:bg-red-800 transition">
                Publish Listing
            </button>

        </form>
    </div>

@endsection