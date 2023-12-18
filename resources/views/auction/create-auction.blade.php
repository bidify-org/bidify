<x-layout>
    <div class="container mx-auto mt-6 px-6">
        <h3 class="font-body font-bold text-3xl sm:text-6xl text-black mt-[5.563rem]">Add Auction</h3>
    </div>

    <div class="container mt-6 mx-auto p-6 border-solid border-2 border-grey rounded-lg">
        <h3 class="font-body font-bold text-2xl sm:text-4xl text-black ml-0 sm:ml-[4rem]">Auction Detail</h3>
        <form class="flex flex-row ml-0 sm:ml-[4rem] gap-[2rem] sm:gap-[6rem]" method="POST" action="{{ route('auctions.store') }}"
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
                    <h3 class="font-body font-bold text-2xl text-black">Buy Now Price</h3>
                    <p class="font-body text-1xl text-black">The Buy Now price is the price at which the item can be
                        purchased immediately. <span class="text-primary-blue font-semibold">If you do not want to offer
                            a
                            Buy Now
                            price,
                            leave this at 0.</span></p>
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

            <div class="flex flex-col mt-12 w-[15rem] sm:w-[50rem] max-w-lg ">
                <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                    <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[20rem] sm:mt-[11rem] my-[15px]">
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
                <div class="flex flex-col flex-start gap-[1px] mt-[22rem] sm:mt-[10rem] my-[15px]">
                    <textarea id="description" name="description" type="text" rows="5"
                        class="resize-none p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <label for="description" class=" font-body text-body text-black">
                        Add a clear description of your product
                    </label>
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[16rem] sm:mt-[6rem] my-[15px]">
                    <input id="asking_price" name="asking_price" type="number" value="{{ old('asking_price') ?? 0.00 }}"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('asking_price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[19rem] sm:mt-[10rem] my-[15px]">
                    <input id="buy_now_price" name="buy_now_price" type="number"
                        value="{{ old('buy_now_price') ?? 0.00 }}"
                        class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white " />
                    @error('buy_now_price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col flex-start gap-[1px] mt-[25rem] sm:mt-[12rem] my-[15px]">
                    <input id="ends_at" name="ends_at" type="datetime-local"
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
