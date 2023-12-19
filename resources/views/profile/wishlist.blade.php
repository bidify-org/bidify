<x-layout>
    <x-container>
        <section class="mt-[5.563rem] flex flex-col gap-[10px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Wishlist</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Items you want to buy.</h3>
                </div>
            </div>

            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] gap-x-[20px] items-center mt-[25px] rounded-[10px]">
                @forelse ($wishlists as $item)
                <div class="flex">
                    <x-bid-card ref="{{ route('auctions.show', $item->auction->id) }}"
                        img="{{ $item->auction->image_url }}" title="{{ $item->auction->title }}"
                        price="{{ $item->auction->top_bid_amount }}" endsAt="{{ $item->auction->ends_at }}">
                    </x-bid-card>
                </div>
                @empty
                <p class="flex items-center">No Wishlist</p>
                @endforelse
            </div>


        </section>

        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">You May Like</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Recommended items.</h3>
                </div>
                <x-button-more ref="/auctions"></x-button-more>
            </div>
            <div id="container"
                class="overflow-x-scroll no-scrollbar flex mt-[25px] rounded-[10px] md:gap-[1.2rem] gap-[20px] scroll-smooth">
                @forelse ($recommendations as $item)
                <div class="flex">
                    <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                        title="{{ $item->title }}" price="{{ $item->asking_price }}" endsAt="{{ $item->ends_at }}">
                    </x-bid-card>
                </div>
                @empty
                <p class="flex items-center">No data</p>
                @endforelse
            </div>

            <div class="flex justify-end gap-2 mt-5">
                <button id="slideleft">
                    <img src="/assets/button/prev.svg" alt="" />
                </button>
                <button id="slideright">
                    <img src="/assets/button/next.svg" alt="" />
                </button>
            </div>
        </section>
    </x-container>
</x-layout>
