<x-layout>
    <div class="container mx-auto mt-30 px-0 sm:px-[8rem]">
        <h3 class="font-body font-bold text-3xl sm:text-5xl text-black mt-[5.563rem] ">Your Bids</h3>
    </div>
    <div class="container flex flex-col sm:flex-row mx-0 sm:mx-auto mt-6 mb-40 gap-4 px-0 sm:px-[8rem]">
        <div class="container flex flex-col gap-[2rem] h-fit ">
            <div class="container border-solid border-2 border-grey rounded-lg h-fit p-4">
                {{-- Foreach(?) kalo emang mau ambil item secara dinamis--}}
                <div class="flex items-center gap-[2rem] w-full p-[2rem]">
                    <input type='checkbox' />
                    <img src="{{Storage::url($auction->image_url)}}" class="w-[4rem] h-[4rem] rounded-lg" />
                    <div class='flex justify-between w-[70%]'>
                        <div>
                            <h3>{{$auction->title}}</h3>
                            <p>@money($auction->buy_now_price)</p>
                        </div>
                        <button>
                            <a class="font-body text-gray-600 hover:text-hover-blue">Delete</a>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Recomendations --}}
            <div class="flex flex-col gap-0">
                <div class="flex justify-between items-center ">
                    <div class="flex flex-col font-body">
                        <h1 class="sm:text-main_03 text-title_02">Recommendations</h1>
                    </div>
                    <x-button-more ref="/auctions"></x-button-more>
                </div>

                <div id="container"
                    class="overflow-x-scroll no-scrollbar flex justify-between mt-[25px] rounded-[10px] md:gap-[1.2rem] gap-[20px] scroll-smooth">
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
            </div>

        </div>

        {{-- Summary --}}
        <div
            class="container sm:mx-auto border-solid border-2 border-grey rounded-lg p-10 h-fit sm:w-[60%] flex flex-col gap-[2rem] sticky top-40">
            <h3 class="font-body font-bold text-4xl text-black ">Summary</h3>
            <div class="flex flex-col gap-[2rem]">
                <div class="flex justify-between">
                    <h3>{{$auction->title}}</h3>
                    <h3>@money($auction->buy_now_price)</h3>
                </div>
                <span class="flex border-solid border-[1.5px] border-gray-400 rouded-lg"></span>
            </div>

            <div class="flex justify-between">
                <h3>Total Price</h3>
                <h3>@money($auction->buy_now_price)</h3>
            </div>
            <form action="{{ route('auctions.buyNow', $auction->id) }}"
                class="grid grid-cols-1 gap-4 text-subtitle font-bold" method="post">
                @csrf
                <button
                    class="py-[15px] h-full rounded-[3px] text-white bg-primary-blue hover:bg-light-blue duration-200">
                    Buy Now
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</x-layout>
