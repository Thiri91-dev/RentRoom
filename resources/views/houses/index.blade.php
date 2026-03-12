@extends('layouts.app')
@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-stone-800">Available Rooms</h1>
            <p class="text-stone-500 mt-1">Find rooms for rent across the city</p>
        </div>
        <div class="text-sm text-stone-400">{{ $houses->total() }} listings found</div>
    </div>

    @if($houses->isEmpty())
        <div class="text-center py-24 text-stone-400">
            <div class="text-6xl mb-4">🏘</div>
            <p class="text-lg font-semibold">No listings yet</p>
            <p class="text-sm">Be the first to add a room listing</p>
        </div>
    @else

        <!-- Responsive grid: 1 col mobile, 2 cols tablet, 3 cols desktop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($houses as $house)
                <div class="bg-white rounded-xl border border-stone-200 shadow-sm hover:shadow-md transition-all overflow-hidden">

                    <!-- Card color header based on gender preference -->
                    <div class="h-3
                     @if($house->gender == 1) bg-blue-400
                     @elseif($house->gender == 2) bg-pink-400
                     @else bg-red-700 @endif"></div>

                    <div class="p-5">

                        <!-- Roomtype badge -->
                        <span class="text-xs font-bold uppercase tracking-wide text-red-700 bg-red-50 px-2 py-1 rounded">
                            {{ $house->roomtype ?: 'Room' }}
                        </span>

                        <!-- Address -->
                        <h2 class="text-lg font-bold text-stone-800 mt-3 leading-tight">
                            {{ $house->address ?: 'Address not provided' }}
                        </h2>

                        <!-- Description snippet -->
                        @if($house->description)
                            <p class="text-stone-500 text-sm mt-2 line-clamp-2">{{ $house->description }}</p>
                        @endif

                        <!-- Stats row -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-2xl font-bold text-red-700">
                                ${{ number_format($house->fee) }}<span class="text-sm font-normal text-stone-400">/mo</span>
                            </span>
                            <span class="text-xs text-stone-400">
                                {{ $house->no_avaliablity }} room(s) left
                            </span>
                        </div>

                        <!-- Gender & actions -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-stone-100">
                            <span class="text-xs text-stone-400">{{ $house->gender_label }}</span>
                            <a href="{{ route('houses.show', $house->house_id) }}"
                                class="text-sm font-semibold text-red-700 hover:text-red-900 transition">
                                View Details →
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">{{ $houses->links() }}</div>
    @endif

@endsection