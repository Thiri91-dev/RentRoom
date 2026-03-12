@extends('layouts.app')
@section('content')

    <div class="max-w-3xl mx-auto">

        {{-- Back button --}}
        <a href="{{ route('houses.index') }}"
            class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-red-700 transition mb-6">
            ← Back to Listings
        </a>

        {{-- Main card --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">

            {{-- Colour header bar based on gender --}}
            <div class="h-2
                @if($house->gender == 1) bg-blue-400
                @elseif($house->gender == 2) bg-pink-400
                @else bg-red-700
                @endif">
            </div>

            <div class="p-8">

                {{-- Room type badge --}}
                <span class="text-xs font-bold uppercase tracking-wide text-red-700 bg-red-50 px-3 py-1 rounded">
                    {{ $house->roomtype ?: 'Room' }}
                </span>

                {{-- Address --}}
                <h1 class="text-3xl font-bold text-stone-800 mt-4">
                    {{ $house->address ?: 'Address not provided' }}
                </h1>

                {{-- Posted by --}}
                <p class="text-stone-400 text-sm mt-2">
                    Posted by <strong class="text-stone-600">{{ $house->member->name ?? 'Unknown' }}</strong>
                    · {{ \Carbon\Carbon::parse($house->create_date)->diffForHumans() }}
                </p>

                <hr class="my-6 border-stone-100">

                {{-- Key stats grid — responsive --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">

                    <div class="bg-stone-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-red-700">${{ number_format($house->fee) }}</p>
                        <p class="text-xs text-stone-400 mt-1">per month</p>
                    </div>

                    <div class="bg-stone-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-stone-700">{{ $house->no_avaliablity }}</p>
                        <p class="text-xs text-stone-400 mt-1">rooms available</p>
                    </div>

                    <div class="bg-stone-50 rounded-lg p-4 text-center">
                        <p class="text-lg font-bold text-stone-700">
                            @if($house->gender == 1) 👨 Male
                            @elseif($house->gender == 2) 👩 Female
                            @else 👥 Any
                            @endif
                        </p>
                        <p class="text-xs text-stone-400 mt-1">gender preference</p>
                    </div>

                    <div class="bg-stone-50 rounded-lg p-4 text-center">
                        <p class="text-lg font-bold text-stone-700">{{ $house->roomtype ?: '—' }}</p>
                        <p class="text-xs text-stone-400 mt-1">room type</p>
                    </div>

                </div>

                {{-- Description --}}
                @if($house->description)
                    <div class="mb-6">
                        <h2 class="text-sm font-bold uppercase tracking-wide text-stone-400 mb-2">Description</h2>
                        <p class="text-stone-600 leading-relaxed">{{ $house->description }}</p>
                    </div>
                @endif

                {{-- Contact / member info --}}
                @if($house->member)
                    <div class="bg-stone-50 rounded-lg p-5 mb-6">
                        <h2 class="text-sm font-bold uppercase tracking-wide text-stone-400 mb-3">Contact Owner</h2>
                        <p class="font-semibold text-stone-800">{{ $house->member->name }}</p>
                        <p class="text-stone-500 text-sm mt-1">📧 {{ $house->member->email }}</p>
                        @if($house->member->mobile_no)
                            <p class="text-stone-500 text-sm mt-1">📱 {{ $house->member->mobile_no }}</p>
                        @endif
                    </div>
                @endif

                {{-- Action buttons — only show to the owner --}}
                @auth
                    @if(Auth::id() == $house->member_id)
                        <div class="flex flex-col sm:flex-row gap-3">

                            <a href="{{ route('houses.edit', $house->house_id) }}" class="flex-1 text-center bg-stone-800 text-white py-3 rounded-lg font-semibold
                                          hover:bg-stone-900 transition">
                                ✏️ Edit Listing
                            </a>

                            <form method="POST" action="{{ route('houses.destroy', $house->house_id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this listing?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-red-100 text-red-700 rounded-lg
                                                   font-semibold hover:bg-red-200 transition">
                                    🗑 Delete
                                </button>
                            </form>

                        </div>
                    @endif
                @endauth

            </div>
        </div>

        {{-- Last updated --}}
        <p class="text-center text-xs text-stone-400 mt-4">
            Last updated {{ \Carbon\Carbon::parse($house->update_date)->format('d M Y, H:i') }}
        </p>

    </div>

@endsection