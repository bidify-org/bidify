<x-layout>
    <div class="container mx-auto mt-30 px-[8rem]">
        <h3 class="font-body font-bold text-3xl sm:text-5xl text-black mt-[5.563rem] ">Your Bids</h3>
    </div>
    <div class="container flex mx-auto mt-6 mb-40 gap-4 px-[8rem]">
        <div class="container flex flex-col gap-[2rem] h-fit ">
            <div class="container border-solid border-2 border-grey rounded-lg h-fit p-4">
                {{-- Foreach(?) kalo emang mau ambil item secara dinamis--}}
                <div class="flex items-center gap-[2rem] w-full p-[2rem]">
                    <input type='checkbox'>
                    <div class=" w-[4rem] h-[4rem] bg-sky-500 rounded-lg"></div>
                    <div class='flex justify-between w-[70%]'>
                        <div>
                            <h3>Jetset Radio Sega Authentic Copy</h3>
                            <p>Rp577.500</p>
                        </div>
                        <button>
                            <a class="font-body text-gray-600 hover:text-hover-blue">Delete</a>
                        </button>
                    </div>
                </div>
                <span class="flex border-solid border-[1.5px] border-gray-400 rouded-lg ml-5 mr-5"></span>

                <div class="flex items-center gap-[2rem] w-full p-[2rem]">
                    <input type='checkbox'>
                    <div class=" w-[4rem] h-[4rem] bg-sky-500 rounded-lg"></div>
                    <div class='flex justify-between w-[70%]'>
                        <div>
                            <h3>Jetset Radio Sega Authentic Copy</h3>
                            <p>Rp577.500</p>
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
                        <h1 class="sm:text-main_03 text-title_02">Reccomendations</h1>
                    </div>
                    <x-button-more ref="/auctions"></x-button-more>
                </div>
    
                <div id="container"
                    class="overflow-x-scroll no-scrollbar flex justify-between mt-[25px] rounded-[10px] md:gap-[1.2rem] gap-[20px] scroll-smooth">
                    @forelse ($data as $item)
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
        <div class="container mx-auto border-solid border-2 border-grey rounded-lg p-10 h-fit w-[60%] flex flex-col gap-[2rem]">
            <h3 class="font-body font-bold text-4xl text-black ">Summary</h3>
            <div class="flex flex-col gap-[2rem]">
                <div class="flex justify-between">
                    <h3>JetSet Radio Rare</h3>
                    <h3>Rp110.000</h3>
                </div>
                <span class="flex border-solid border-[1.5px] border-gray-400 rouded-lg"></span>
            </div>
            
            <div class="flex justify-between">
                <h3>Total Price</h3>
                <h3>Rp110.000</h3>
            </div>

            <form class="grid grid-cols-1 gap-4 text-subtitle font-bold" method="">
                <div>
                    {{-- <h1 class="sm:text-title_02 font-bold">@money($auction->buy_now_price)</h1> --}}
                </div>

                <button
                    class="py-[15px] h-full rounded-[3px] text-white bg-primary-blue hover:bg-light-blue duration-200">
                    Buy Now
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</x-layout>
