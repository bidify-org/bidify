<x-layout>
    <div class="mb-4 mt-4 p-6 border-2 border-gray-2 rounded-2xl">
        <div class="flex items-start space-x-6">
            <img class="max-w-xl" src="{{ $auction->image_url }}" alt="">
            <section class="w-full">
                <div class="w-full flex justify-between">
                    <h1 class="mb-6 text-4xl font-bold">Title: {{ $auction->title }}</h1>
                    @auth()
                    @if (auth()->user()->id === $auction->seller_id)
                    <form action="/auctions/{{ $auction->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                    @endif
                    @endauth
                </div>
                <h2 class="text-lg">Seller: {{ $auction->seller->username}}</h2>
                <h2 class="text-lg">Winner: {{ $auction->winner ? $auction->winner->username : 'No winner yet' }}</h2>
                <p class="text-primary-blue text-xl">{{ $auction->description }}</p>
                <p class="text-green-600 text-lg">Starts at: @money($auction->asking_price)</p>

                <div class="flex items-center space-x-4">
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
</x-layout>
