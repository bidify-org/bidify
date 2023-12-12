<x-layout>
    <x-container>
        <section class="mt-[5.563rem]">
            <div class="mb-[15px]">{{ Breadcrumbs::render('search') }}</div>
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Search Result</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Showing {{ count($data) }} Products for
                        <span class="font-bold text-black">"{{ $searchTerm }}"</span>
                    </h3>
                </div>
            </div>

            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
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

        </section>
        {{-- {{ $data->links() }} --}}
    </x-container>
</x-layout>
