<x-layout>
    <x-container>
        <section class="mt-[5.563rem]">
            <div class="flex sm:flex-row flex-col sm:gap-10 gap-5 sm:items-center items-start">
                <img src="assets/profile_dummy.jpeg" class="w-[200px] h-[200px] object-cover rounded-full" />
                <div>
                    <h1 class="text-main_02 mb-2">{{ $data->user->username }}</h1>
                    <p class="text-subtitle text-black/70">{{ $data->user->name }}</p>
                    <p class="text-subtitle text-black/70">{{ $data->user->email }}</p>
                    @if ($data->user->address)
                    <p class="text-subtitle text-black/70">{{ $data->user->address }}</p>
                    <button id="editAddressBtn"
                        class="bg-primary-blue hover:bg-hover-blue duration-200 text-white px-3 py-2 rounded-[10px] my-2">Edit
                        Address</button>
                    <form id="editAddressForm" class="@if(!$errors->any()) hidden @else flex @endif flex-col"
                        method="POST" action="{{ route('profile.updateAddress') }}">
                        @method('PATCH')
                        @csrf
                        <textarea id="address" name="address" type="text" rows="5"
                            class="p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white"
                            placeholder="Address">{{ old('address') }}</textarea>
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="bg-primary-blue hover:bg-hover-blue duration-200 text-white px-3 py-2 rounded-[10px] my-2">Save
                            Address</button>
                    </form>
                    @else
                    <p class="text-subtitle text-red-400 ">Address not assigned yet.</p>
                    <form class="flex flex-col" method="POST" action="{{ route('profile.updateAddress') }}">
                        @method('PATCH')
                        @csrf
                        <textarea id="address" name="address" type="text" rows="5"
                            class="p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white"
                            placeholder="Address">{{ old('address') }}</textarea>
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="bg-primary-blue hover:bg-hover-blue duration-200 text-white px-3 py-2 rounded-[10px] my-2">Save
                            Address</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="flex items-start border-b-[1px] border-gray-3 mt-[35px]">
        </section>

        {{-- List klo dia menang bid --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">Purchase History</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Auctions you've won.</h3>
                </div>
            </div>
            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse ($data->wonAuctions as $item)
                <div class="flex">
                    <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                        title="{{ $item->title }}" price="{{ $item->asking_price }}" endsAt="{{ $item->ends_at }}">
                    </x-bid-card>
                </div>
                @empty
                <p class="flex items-center">No Auctions won</p>
                @endforelse
            </div>
        </section>

        {{-- list klo dia masih naro bid (ongoing bid) --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">My Bids</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Your bids.</h3>
                </div>
            </div>
            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse ($data->bids as $item)
                <div class="flex">
                    <x-bid-card ref="{{ route('auctions.show', $item->auction->id) }}"
                        img="{{ $item->auction->image_url }}" title="{{ $item->auction->title }}"
                        price="{{ $item->auction->asking_price }}" endsAt="{{ $item->auction->ends_at }}">
                    </x-bid-card>
                </div>
                @empty
                <p class="flex items-center">No Bids</p>
                @endforelse
            </div>
        </section>
        </section>

        {{-- barang yg dia jual --}}
        <section class="mt-[35px]">
            <div class="flex justify-between items-center">
                <div class="flex flex-col font-body">
                    <h1 class="sm:text-main_03 text-title_02">My Auctions</h1>
                    <h3 class="sm:text-subtitle text-body text-black/50">Your Auctions.</h3>
                </div>
            </div>
            <div
                class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] sm:gap-x-0 gap-x-[20px] justify-between items-center mt-[25px] rounded-[10px]">
                @forelse ($data->ownedAuctions as $item)
                <div class="flex">
                    <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                        title="{{ $item->title }}" price="{{ $item->asking_price }}" endsAt="{{ $item->ends_at }}">
                    </x-bid-card>
                </div>
                @empty
                <p class="flex items-center">No Auctions</p>
                @endforelse
            </div>
        </section>
    </x-container>
    @push('scripts')
    <script type="text/javascript">
        let isEditAddressFormVisible = {{ $errors->any() ? 'true' : 'false' }}
        const toggleEditAddressForm = () => {
            if (isEditAddressFormVisible) {
                hideEditAddress();
                isEditAddressFormVisible = false;
            } else {
                showEditAddress();
                isEditAddressFormVisible = true;
            }
        }

        const showEditAddress = () => {
            document.getElementById('editAddressForm').classList.remove('hidden');
            document.getElementById('editAddressForm').classList.add('flex');
        }

        const hideEditAddress = () => {
            document.getElementById('editAddressForm').classList.add('hidden');
            document.getElementById('editAddressForm').classList.remove('flex');
        }

        const editAddressBtn = document.getElementById('editAddressBtn');
        editAddressBtn.addEventListener('click', toggleEditAddressForm);
    </script>
    @endpush
</x-layout>
