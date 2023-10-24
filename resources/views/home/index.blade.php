<x-layout>
    <main class="font-body container mx-auto px-12">
        <h1 class="text-9xl">Home</h1>

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
            <li class="mb-2">{{ $auction->title }}</li>
            @endforeach
        </ul>
    </main>
</x-layout>
