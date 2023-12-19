<x-layout>
    <main class="font-body container mx-auto px-12">

        <section class="mt-[5.563rem] flex flex-col gap-[10px]">
            <div
                class="m-auto w-full rounded-[10px] aspect-[calc(16/5)] relative overflow-hidden flex items-center justify-center">
                <img src="/dummy/caraousel-1.png" alt="" />
            </div>
        </section>

        {{-- recommendation section --}}
        <section class="mt-[25px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">

                    <h1 class="sm:text-main_03 text-title_02">
                        {{ auth()->check() ? 'For ' . auth()->user()->username : 'Recommended For You' }} </h1>

                    <h3 class="sm:text-subtitle text-body text-black/50">Recommended items for you.</h3>
                </div>
                <x-button-more ref="/auctions"></x-button-more>
            </div>

            <div id="container"
                class="overflow-x-scroll no-scrollbar flex mt-[25px] rounded-[10px] md:gap-[1.2rem] gap-[20px] scroll-smooth">
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

            <div class="flex justify-end gap-2 mt-5">
                <button id="slideleft">
                    <img src="/assets/button/prev.svg" alt="" />
                </button>
                <button id="slideright">
                    <img src="/assets/button/next.svg" alt="" />
                </button>
            </div>
        </section>


        {{-- bento --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Featured By Bidify</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Bidify Guarantee.</h3>
                </div>
            </div>

            <div class="mt-[25px] grid md:grid-cols-3 grid-cols-1 md:gap-[20px] gap-0 w-full font-body">
                <div
                    class="transform transition-transform duration-500 ease-in-out hover:scale-[1.03] border-[1px] cursor-pointer rounded-[10px] border-gray-3 h-auto flex flex-col justify-center items-center">
                    <img class="" src="/bento/left.png" alt="" />
                    <p class="mb-[5rem] text-body font-body">
                        Available on 12/10/2023
                    </p>
                </div>

                <div class="grid grid-cols-3 col-span-2 sm:gap-[20px] gap-[10px]">
                    <div
                        class="transform transition-transform duration-500 ease-in-out hover:scale-[1.03] cursor-pointer border-[1px] md:mt-0 mt-[10px] rounded-[10px] border-gray-3 col-span-3 p-4 h-auto">
                        <div class="grid grid-cols-4 p-4 items-center justify-center justify-items-center">
                            <div class="flex flex-col justify-center">
                                <img class="max-w-[80%]" src="/bidify_logo/logo_text_blue.svg" alt="" />
                                <img class="max-w-[60%]" src="/payment_svg/dana.svg" alt="" />
                            </div>
                            <h1 class="lg:text-[1.5rem] text-title-03 font-normal">
                                Get
                            </h1>

                            <h1 class="xl:text-display_02 text-[2.2rem] font-bold text-primary-blue">
                                50%
                            </h1>
                            <h1 class="lg:text-[1.5rem] text-title_03 font-normal">
                                Cashback
                            </h1>
                        </div>
                    </div>

                    <div
                        class="transform transition-transform duration-500 ease-in-out hover:scale-[1.03] cursor-pointer border-[1px] rounded-[10px] border-gray-3 col-span-2 flex flex-col gap-2 h-auto p-5 items-center justify-center">
                        <div
                            class="sm:text-main_03 text-title_01 flex gap-3 items-center flex-wrap text-center justify-center">
                            Hyundai <span class="font-normal">IONIQ</span> 5
                        </div>
                        <p class="text-body text-primary-blue">Starts at</p>
                        <img src="/bento/hyundaiii.png" alt="" />
                        <h1 class="sm:text-title_01 text-title_02 font-normal text-center">
                            IDR <span class="font-bold">100.000.000</span>
                        </h1>
                        <p class="text-body text-primary-blue">
                            Available on 10/10/2023
                        </p>
                    </div>

                    <div
                        class="transform transition-transform duration-500 ease-in-out hover:scale-[1.03] cursor-pointer border-[1px] rounded-[10px] border-gray-3 col-span-1 flex flex-col gap-2 p-5 items-center justify-center">
                        <img src="/bento/ps5_logo.png" class="max-w-[80%]" alt="" />
                        <p class="text-body text-primary-blue">Starts at</p>
                        <img src="/bento/ps5.png" class="max-w-[80%]" alt="" />
                        <h1 class="sm:text-title_01 text-[1.3rem] font-normal text-center">
                            IDR <span class="font-bold">500.000</span>
                        </h1>
                        <p class="text-body text-primary-blue text-center">
                            Available on 10/12/2023
                        </p>
                    </div>
                </div>
            </div>
        </section>


        {{-- category --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Popular</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">See the most popular category.</h3>
                </div>
                <x-button-more ref="/auctions"></x-button-more>
            </div>

            <div class="flex gap-5 mt-[25px] justify-between overflow-auto no-scrollbar rounded-[10px]">
                <div class="flex md:gap-[3rem] gap-3 justify-between ">
                    <div
                        class="md:w-[20rem] w-[13rem] cursor-pointer h-auto border-solid border-[1px] border-gray-3 rounded-[10px] bg-[#F2F8FF] overflow-clip font-body">
                        <img src=/category/tv.jpg alt="" />
                        <p class="px-4 py-2 text-body_bold">Television</p>
                    </div>
                    <div
                        class="md:w-[20rem] w-[13rem] cursor-pointer h-auto border-solid border-[1px] border-gray-3 rounded-[10px] bg-[#F2F8FF] overflow-clip font-body">
                        <img src=/category/smartphone.jpg alt="" />
                        <p class="px-4 py-2 text-body_bold">Smartphone</p>
                    </div>
                    <div
                        class="md:w-[20rem] w-[13rem] cursor-pointer h-auto border-solid border-[1px] border-gray-3 rounded-[10px] bg-[#F2F8FF] overflow-clip font-body">
                        <img src=/category/keyboard.jpg alt="" />
                        <p class="px-4 py-2 text-body_bold">Keyboard</p>
                    </div>
                    <div
                        class="md:w-[20rem] w-[13rem] cursor-pointer h-auto border-solid border-[1px] border-gray-3 rounded-[10px] bg-[#F2F8FF] overflow-clip font-body">
                        <img src=/category/headphones.jpg alt="" />
                        <p class="px-4 py-2 text-body_bold">Headphones</p>
                    </div>
                </div>
            </div>
        </section>


        {{-- Others --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">You May Like It</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Other electronic items that you may like.</h3>
                </div>
            </div>

            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse ($data as $item)
                    <div class="flex">
                        <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                            title="{{ $item->title }}" price="{{ $item->asking_price }}"
                            endsAt="{{ $item->ends_at }}">
                        </x-bid-card>
                    </div>
                @empty
                    <p class="flex items-center">No data</p>
                @endforelse
            </div>

        </section>




        {{-- contoh aja --}}
        {{-- <h1 class="my-12 font-body font-bold text-6xl text-gray-3">Home</h1>

        <a href="/logout">
            <button class="w-32 h-12 text-white font-bold rounded-xl bg-red-500 hover:bg-red-700 duration-150">
                Logout
            </button>
        </a>

        <!-- Authenticated user -->
        <h1 class="text-2xl">Welcome, {{ auth()->user()->username }}</h1>
        <h1 class="mt-6 font-bold text-xl">Links</h1>
        <ul class="text-blue-500 underline">
            <li>
                <a href="/auctions/create">Create auctions</a>
            </li>
        </ul>

        <h1 class="mt-6 font-bold text-xl">User Details</h1>
        <ul>
            <li>Name: {{ auth()->user()->name }}</li>
            <li>Email: {{ auth()->user()->email }}</li>
            <li>Username: {{ auth()->user()->username }}</li>
        </ul>

        <h1 class="mt-6 font-bold text-xl">My Auctions</h1>
        <ul>
            @foreach (auth()->user()->auctions as $auction)
            <div class="mb-4 mt-4 p-6 border border-gray-2 rounded-2xl">
                <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-6">
                    <img class="w-full lg:max-w-sm h-full rounded-xl select-none" src="{{ $auction->image_url }}"
                        alt="">
                    <section class="flex flex-col justify-around">
                        <h1 class="text-xl md:text-4xl font-bold">Title: {{ $auction->title }}</h1>
                        <section>
                            <h2 class="text-lg">Seller: {{ $auction->seller->username }}</h2>
                            <h2 class="text-lg">Winner:
                                {{ $auction->winner ? $auction->winner->username : 'No winner yet' }}
                            </h2>
                        </section>

                        <section>
                            <p class="text-primary-blue text-lg md:text-xl">{{ $auction->description }}</p>
                            <p class="text-green-600 text-lg">Starts at: @money($auction->asking_price)</p>
                        </section>

                        <div class="flex flex-col mt-4 md:mt-0 md:flex-row md:items-center md:space-x-4">
                            <section>
                                <span>Ends at: </span>
                                <span class="text-red-600">{{ $auction->ends_at }}</span>
                            </section>
                            <section>
                                <span>Started at: </span>
                                <span class="text-green-600">{{ $auction->created_at }}</span>
                            </section>
                        </div>
                    </section>
                </div>
            </div>
            @endforeach
        </ul> --}}
    </main>
</x-layout>
