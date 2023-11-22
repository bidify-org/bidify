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
                    @if (auth()->check())
                        <h1 class="sm:text-main_03 text-title_02">For {{ auth()->user()->username }}</h1>
                    @else
                        <h1 class="sm:text-main_03 text-title_02">Recommended For You</h1>
                    @endif
                    <h3 class="sm:text-subtitle text-body text-black/50">Recommended items for you.</h3>
                </div>
                <x-button-more ref="/auctions"></x-button-more>
            </div>

            <div id="container"
                class="overflow-x-scroll no-scrollbar flex mt-[25px] rounded-[10px] md:gap-[1.2rem] gap-[20px]">
                @forelse ($data as $item)
                    <div class="flex">
                        <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                            title="{{ $item->title }}" price="{{ $item->asking_price }}">
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






        {{-- contoh aja --}}
        <h1 class="my-12 font-body font-bold text-6xl text-gray-3">Home</h1>

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
                <a href="/auctions">List all auctions</a>
            </li>
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
                                    {{ $auction->winner
                                        ? $auction->winner->username
                                        : 'No winner
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    yet' }}
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
        </ul>
    </main>
</x-layout>
