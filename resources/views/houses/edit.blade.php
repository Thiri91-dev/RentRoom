@extends('layouts.app')
@section('content')

    <div class="max-w-2xl mx-auto">

        <a href="{{ route('houses.show', $house->house_id) }}"
            class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-red-700 transition mb-6">
            ← Back to Listing
        </a>

        <h1 class="text-3xl font-bold text-stone-800 mb-2">Edit Listing</h1>
        <p class="text-stone-500 mb-8">Update the details for this room listing.</p>

        <form method="POST" action="{{ route('houses.update', $house->house_id) }}"
            class="bg-white rounded-xl border border-stone-200 shadow-sm p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Address --}}
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">
                    Address <span class="text-red-600">*</span>
                </label>
                <input type="text" name="address" value="{{ old('address', $house->address) }}" maxlength="100"
                    placeholder="e.g. 123 Main Street, Yangon" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                              focus:ring-2 focus:ring-red-600 focus:border-transparent outline-none">
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fee + Room Type --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">
                        Monthly Fee ($) <span class="text-red-600">*</span>
                    </label>
                    <input type="number" name="fee" value="{{ old('fee', $house->fee) }}" min="0" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                                  focus:ring-2 focus:ring-red-600 outline-none">
                    @error('fee')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">
                        Room Type <span class="text-red-600">*</span>
                    </label>
                    <select name="roomtype" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                                   focus:ring-2 focus:ring-red-600 outline-none">
                        <option value="Single Room" {{ old('roomtype', $house->roomtype) == 'Single Room' ? 'selected' : '' }}>Single Room</option>
                        <option value="Shared Room" {{ old('roomtype', $house->roomtype) == 'Shared Room' ? 'selected' : '' }}>Shared Room</option>
                        <option value="Studio" {{ old('roomtype', $house->roomtype) == 'Studio' ? 'selected' : '' }}>Studio
                        </option>
                        <option value="Apartment" {{ old('roomtype', $house->roomtype) == 'Apartment' ? 'selected' : '' }}>
                            Apartment</option>
                        <option value="House" {{ old('roomtype', $house->roomtype) == 'House' ? 'selected' : '' }}>Whole House
                        </option>
                    </select>
                </div>
            </div>

            {{-- Gender + Availability --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">Gender Preference</label>
                    <select name="gender" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                                   focus:ring-2 focus:ring-red-600 outline-none">
                        <option value="0" {{ old('gender', $house->gender) == 0 ? 'selected' : '' }}>Any Gender</option>
                        <option value="1" {{ old('gender', $house->gender) == 1 ? 'selected' : '' }}>Male Only</option>
                        <option value="2" {{ old('gender', $house->gender) == 2 ? 'selected' : '' }}>Female Only</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-stone-700 mb-1">Rooms Available</label>
                    <input type="number" name="no_avaliablity" value="{{ old('no_avaliablity', $house->no_avaliablity) }}"
                        min="0" class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                                  focus:ring-2 focus:ring-red-600 outline-none">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Description</label>
                <textarea name="description" rows="4" placeholder="Describe the room, facilities, location..."
                    class="w-full border border-stone-300 rounded-lg px-4 py-2.5
                                 focus:ring-2 focus:ring-red-600 outline-none resize-none">{{ old('description', $house->description) }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 bg-red-700 text-white py-3 rounded-lg font-bold
                               hover:bg-red-800 transition">
                    Save Changes
                </button>
                <a href="{{ route('houses.show', $house->house_id) }}" class="flex-1 text-center bg-stone-100 text-stone-700 py-3 rounded-lg font-bold
                          hover:bg-stone-200 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

@endsection