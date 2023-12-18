<x-layout>
    <div class="container mx-auto mt-6 px-6">
        <h3 class="font-body font-bold text-6xl text-black mt-[5.563rem]">Add Auction</h3>
    </div>

    <div class="container mt-6 mx-auto p-6 border-solid border-2 border-grey rounded-lg">
        <h3 class="font-body font-bold text-4xl text-black ml-[4rem]">Auction Detail</h3>
        <form class="flex flex-row ml-[4rem] gap-[6rem]" method="POST" action="{{ route('auctions.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mt-12 w-[36rem] max-w-lg padding: 10px gap-[9rem]">
                <div>
                    <h3 class="font-body font-bold text-2xl text-black">Product Picture</h3>
                    <p class="font-body text-1xl text-black">Image format .jpg .jpeg .png and minimum size of 300 x
                        300px (For optimal image use minimum size of 700 x 700 px)</p>
                </div>
                <div>
                    <h3 class="font-body font-bold text-2xl text-black">Product Name</h3>
                    <p class="font-body text-1xl text-black">Make sure the product description includes detailed
                        explanations about your product so that buyers can easily understand and find your product.</p>
                </div>
                <div class="mb-[2rem]">
                    <h3 class="font-body font-bold text-2xl text-black">Product Description</h3>
                    <p class="font-body text-1xl text-black">Make sure the product description includes detailed
                        explanations about your product so that buyers can easily understand and find your product.</p>

                </div>
                <div>
                    <h3 class="font-body font-bold text-2xl text-black">Asking Price</h3>
                    <p class="font-body text-1xl text-black">Set a clear and attractive price in your auction listing to
                        showcase your item's value.</p>
                </div>
                <div>
                    <h3 class="font-body font-bold text-2xl text-black">Auction End Date</h3>
                    <p class="font-body text-1xl text-black">Specify a clear and definite end time for your auction to
                        create a sense of urgency and help bidders make timely decisions.</p>
                </div>
                <div class="flex flex-col justify-around gap-2 mb-[2rem] my-[36px]">
                    <button type="submit"
                        class="flex justify-center items-center h-[52px] disabled:opacity-75 font-body text-body text-white bg-primary-blue py-2  hover:bg-hover-blue rounded-lg duration-100">
                        Publish
                    </button>
                </div>
            </div>

            <div class="flex flex-col mt-12 w-[50rem] max-w-lg ">
                <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                    <input id="image" name="image" type="file" accept="image/jpeg,image/png"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div class="flex flex-col flex-start gap-10 my-15">
                    <div class="flex items-center justify-start w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-48 h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white relative">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Click to upload</p>
                            </div>
                            <input id="dropzone-file" type="file"
                                class="hidden absolute top-0 left-0 w-full h-full opacity-0" />
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>
                    {{-- <div id="image-preview"
                        class="w-48 h-48 bg-cover bg-center bg-no-repeat border-2 border-gray-300 border-dashed rounded-lg">
                    </div> --}}
                    {{--
                </div> --}}
                <div class="flex flex-col flex-start gap-[1px] mt-[4rem] my-[15px]">
                    <input id="title" name="title" type="text" value="{{ old('title') }}"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white placeholder:italic placeholder:text-slate-400 "
                        placeholder="Input product name.." />
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <label for="name" class="font-body text-body text-nlack">
                        <span class="text-red-500">*</span> Product name cannot be changed afterwards
                    </label>
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[9rem] my-[15px]">
                    <textarea id="description" name="description" type="text" rows="5"
                        class="p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <label for="description" class="font-body text-body text-black">
                        Add a clear description of your product
                    </label>
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[7rem] my-[15px]">
                    <input id="asking_price" name="asking_price" type="number" value="{{ old('asking_price') ?? 0.00 }}"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('asking_price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[10rem] my-[15px]">
                    <input id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at') }}"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('ends_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</x-layout>
