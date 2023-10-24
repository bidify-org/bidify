<x-layout>
    <main class="font-body container mx-auto px-12">
        <h1 class="text-9xl">Home</h1>

        <a href="/logout">
            <button class="w-32 h-12 text-white font-bold rounded-xl bg-red-500 hover:bg-red-700 duration-150">
                Logout
            </button>
        </a>

        <!-- Authenticated user -->
        <h1 class="text-2xl">Welcome, {{ auth()->user()->username }}</h1>

        <h1 class="mt-6 font-bold text-xl">User Details</h1>
        <ul>
            <li>Name: {{ auth()->user()->name }}</li>
            <li>Email: {{ auth()->user()->email }}</li>
            <li>Username: {{ auth()->user()->username }}</li>
        </ul>

        <h1 class="mt-6 font-bold text-xl">User Auctions</h1>
        <ul>
            @foreach (auth()->user()->auctions as $auction)
            <div class="mb-4 mt-4 p-6 border border-gray-2 rounded-2xl">
                <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-6">
                    <img class="w-full lg:max-w-sm h-full rounded-xl select-none" src="{{ $auction->image_url }}"
                        alt="">
                    <section class="flex flex-col justify-around">
                        <h1 class="text-xl md:text-4xl font-bold">Title: {{ $auction->title }}</h1>
                        <section>
                            <h2 class="text-lg">Seller: {{ $auction->seller->username}}</h2>
                            <h2 class="text-lg">Winner: {{ $auction->winner->username}}</h2>
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
