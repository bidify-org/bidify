<x-layout>
    <div class="container mx-auto mt-6 px-6">
        <h1 class="font-body font-bold text-6xl text-gray-3">Auction / Create</h1>
        <form class="mt-12 justify-center max-w-lg" method="POST" action="{{ route('auctions.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                <label for="image" class="font-body text-body text-primary-blue">
                    Item Image
                </label>
                <input id="image" name="image" type="file" accept="image/jpeg,image/png"
                    class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                <label for="title" class="font-body text-body text-primary-blue">
                    Title
                </label>
                <input id="title" name="title" type="text" value="{{ old('title') }}"
                    class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                <label for="description" class="font-body text-body text-primary-blue">
                    Description
                </label>
                <textarea id="description" name="description" type="text" rows="5"
                    class="p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                <label for="asking_price" class="font-body text-body text-primary-blue">
                    Asking Price
                </label>
                <input id="asking_price" name="asking_price" type="number" value="{{ old('asking_price') ?? 0.00 }}"
                    class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                @error('asking_price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                <label for="ends_at" class="font-body text-body text-primary-blue">
                    Ends At
                </label>
                <input id="ends_at" name="ends_at" type="datetime-local"
                    class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                @error('ends_at')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col justify-around gap-2 my-[36px]">
                <button type="submit"
                    class="flex justify-center items-center h-[52px] disabled:opacity-75 font-body text-body text-white bg-primary-blue py-2  hover:bg-hover-blue rounded-lg duration-100">
                    Publish
                </button>
            </div>
        </form>
    </div>
</x-layout>
