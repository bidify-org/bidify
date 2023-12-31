<x-layout>
    <x-container>
        <section class="mt-[5.563rem]">
            <div class="mb-[15px]">{{ Breadcrumbs::render('auctions') }}</div>
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Auction List</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Showing
                        <span>{{ count($data) }}</span> Products
                    </h3>
                </div>
            </div>

            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse ($data as $item)
                    <div class="flex">
                        <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                            title="{{ $item->title }}" price="{{ $item->top_bid_amount }}"
                            endsAt="{{ $item->ends_at }}">
                        </x-bid-card>
                    </div>
                @empty
                    <p class="flex items-center">No data</p>
                @endforelse
            </div>

        </section>
    </x-container>
</x-layout>

{{-- <div class="container mx-auto mt-6 px-6">

        <h1 class="font-body font-bold text-6xl text-gray-3">Auction / List</h1>
        {{ Breadcrumbs::render('auctions') }}


        @if (session('success'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($data as $item)
            <a href="{{ route('auctions.show', $item->id) }}">
                <div class="mb-4 mt-4 p-6 border-2 border-gray-2 rounded-2xl">
                    <div class="flex items-start space-x-6">
                        <img class="max-w-xl" src="{{ $item->image_url }}" alt="">
                        <section class="w-full">
                            <div class="w-full flex justify-between">
                                <h1 class="mb-6 text-4xl font-bold">Title: {{ $item->title }}</h1>
                                @auth()
                                    @if (auth()->user()->id === $item->seller_id)
                                        <form action="/auctions/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <h2 class="text-lg">Seller: {{ $item->seller->username }}</h2>
                            <h2 class="text-lg">Winner: {{ $item->winner ? $item->winner->username : 'No winner yet' }}
                            </h2>
                            <p class="text-primary-blue text-xl">{{ $item->description }}</p>
                            <p class="text-green-600 text-lg">Starts at: @money($item->asking_price)</p>

                            <div class="flex items-center space-x-4">
                                <section>
                                    <span>Ends at: </span>
                                    <span class="text-red-600">{{ $item->ends_at }}</span>
                                </section>
                                <section>
                                    <span>Started at: </span>
                                    <span class="text-green-600">{{ $item->created_at }}</span>
                                </section>
                            </div>
                        </section>
                    </div>
                </div>
            </a>
        @endforeach
    </div> --}}
