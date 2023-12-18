<x-layout>
    <x-container>
        <section class="mt-[5.563rem]">
            <div class="flex sm:flex-row flex-col sm:gap-10 gap-5 sm:items-center items-start">
                <img src="assets/profile_dummy.jpeg" class="w-[200px] h-[200px] object-cover rounded-full" />
                <div>
                    <h1 class="text-main_02 mb-2">{{ auth()->user()->username }}</h1>
                    <p class="text-subtitle text-black/70">{{ auth()->user()->name }}</p>
                    <p class="text-subtitle text-black/70">{{ auth()->user()->email }}</p>
                    @if (auth()->user()->address)
                        <p class="text-subtitle text-black/70">{{ auth()->user()->address }}</p>
                    @else
                        <p class="text-subtitle text-red-400 ">Address not assigned yet.</p>
                    @endif
                </div>
            </div>
            <div class="flex items-start border-b-[1px] border-gray-3 mt-[35px]">
        </section>

        {{-- List klo dia menang bid --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Purchase History</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">The auction you've won.</h3>
                </div>
            </div>
        </section>

        {{-- list klo dia masih naro bid (ongoing bid) --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">My Bids</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Your bids.</h3>
                </div>
            </div>
        </section>

        {{-- barang yg dia jual --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">My Auctions</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Your Auctions.</h3>
                </div>
            </div>
            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse (auth()->user()->auctions as $auction)
                    <div class="flex">
                        <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                            title="{{ $item->title }}" price="{{ $item->asking_price }}" endsAt="{{ $item->ends_at }}">
                        </x-bid-card>
                    </div>
                @empty
                    <p class="flex items-center">No Auctions</p>
                @endforelse
            </div>
        </section>
    </x-container>
</x-layout>
