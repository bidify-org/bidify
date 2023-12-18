<x-layout>
    <style>
        .active-tab {
            border-bottom: 2px solid #5B86AC;
            color: #5B86AC;
        }
    </style>

    <x-container>
        <section class="mt-[5.563rem]">
            <div class="flex sm:flex-row flex-col sm:gap-10 gap-5 sm:items-center items-start">
                <img src="assets/profile_dummy.jpeg" class="w-[200px] h-[200px] object-cover rounded-full" />
                <div>
                    <h1 class="text-main_02 mb-2">{{ $data->user->username }}</h1>
                    <p class="text-subtitle text-black/70">{{ $data->user->name }}</p>
                    <p class="text-subtitle text-black/70">{{ $data->user->email }}</p>
                    @if ($data->user->address)
                    <div class="flex items-center gap-3 py-2">
                        <p class="text-subtitle text-black/70">{{ $data->user->address }}</p>
                    </div>
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
        </section>


        <div class="mt-[35px]">
            <ul class="flex border-b border-gray-3">
                <li class="-mb-px mr-1">
                    <button onclick="showTab('tab-transactions')"
                        class="bg-white inline-block py-2 px-4 text-light-blue hover:text-primary-blue font-semibold active-tab transition duration-300 ease-in-out">
                        Transactions
                    </button>
                </li>
                <li class="mr-1">
                    <button onclick="showTab('tab-bids')"
                        class="bg-white inline-block py-2 px-4 text-light-blue hover:text-primary-blue font-semibold transition duration-300 ease-in-out">
                        Bids</button>
                </li>
                <li class="mr-1">
                    <button onclick="showTab('tab-auctions')"
                        class="bg-white inline-block py-2 px-4 text-light-blue hover:text-primary-blue font-semibold transition duration-300 ease-in-out">
                        Account</button>
                </li>
                <li class="mr-1">
                    <button onclick="showTab('tab-account')"
                        class="bg-white inline-block py-2 px-4 text-light-blue hover:text-primary-blue font-semibold transition duration-300 ease-in-out">
                        Account</button>
                </li>
            </ul>

            <section id="tab-transactions" class="py-4 sm:px-4 px-0 min-h-[50vh]">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col font-body">
                            <h1 class="sm:text-main_03 text-title_02">Purchase History</h1>
                            <h3 class="sm:text-subtitle text-body text-black/50">Auctions you've won.</h3>
                        </div>
                    </div>
                    <div
                        class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] gap-x-[20px] items-center mt-[25px] rounded-[10px]">
                        @forelse ($data->wonAuctions as $item)
                        <div class="flex">
                            <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                                title="{{ $item->title }}" price="{{ $item->top_bid_amount }}"
                                endsAt="{{ $item->ends_at }}">
                            </x-bid-card>
                        </div>
                        @empty
                        <p class="flex items-center">No Auctions won</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="tab-bids" class="hidden py-4 sm:px-4 px-0 min-h-[50vh]">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col font-body">
                            <h1 class="sm:text-main_03 text-title_02">My Bids</h1>
                            <h3 class="sm:text-subtitle text-body text-black/50">
                                Auctions you've bid on.
                            </h3>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 justify-between lg:grid-cols-2 xl:gap-0 gap-10">
                        @forelse ($data->biddedAuctions as $auction)
                        <div class="flex flex-col pb-32">
                            <img src="{{ $auction->image_url }}"
                                class="md:h-[320px] md:w-[320px] h-full w-full object-cover" alt="" />
                            <h2 class="text-main_03 font-semibold">{{ $auction->title }}</h2>
                            <p class="text-title_02">@money($auction->top_bid_amount)</p>
                        </div>
                        <div class="max-h-[15rem] overflow-y-auto">

                            <div class="flex justify-center flex-col">
                                <div class="border-b border-gray-3"></div>
                                <div class="py-5 px-3 grid grid-cols-4 text-black/50 font-medium">
                                    <p class="col-span-2">Bidder</p>
                                    <p>Bid Price</p>
                                    <p>Date</p>
                                </div>
                                <div class="border-b border-gray-3"></div>
                            </div>
                            @foreach ($auction->bids as $bid)
                            <div>
                                <div class="flex justify-center flex-col">
                                    <div class="py-5 px-3 grid grid-cols-4 text-black font-medium">
                                        @if($bid->user->id === $auction->winner_id)
                                        <p class="col-span-2 font-bold text-green-600">{{ $bid->user->name }} (Winner)
                                        </p>
                                        <p class="font-bold text-green-600">@money($bid->amount)</p>
                                        <p title="{{ $bid->created_at }}">{{ $bid->created_at->diffForHumans() }}</p>
                                        @else
                                        <p class="col-span-2">{{ $bid->user->name }}</p>
                                        <p>@money($bid->amount)</p>
                                        <p title="{{ $bid->created_at }}">{{ $bid->created_at->diffForHumans() }}</p>
                                        @endif
                                    </div>
                                    <div class="border-b border-gray-3"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- <x-bid-card ref="{{ route('auctions.show', $item->auction->id) }}"
                            img="{{ $item->auction->image_url }}" title="{{ $item->auction->title }}"
                            price="{{ $item->amount }}" endsAt="{{ $item->auction->ends_at }}">
                        </x-bid-card> --}}
                        @empty
                    </div>
                    <p class="flex items-center">No Bids</p>
                    @endforelse
                </div>
            </section>

            <section id="tab-auctions" class="hidden py-4 sm:px-4 px-0 min-h-[50vh]">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col font-body">
                            <h1 class="sm:text-main_03 text-title_02">My Auctions</h1>
                            <h3 class="sm:text-subtitle text-body text-black/50">Your Auctions.</h3>
                        </div>
                    </div>
                    <div
                        class="no-scrollbar grid sm:grid-cols-[repeat(auto-fit,minmax(0,13rem))] grid-cols-2 gap-y-[30px] gap-x-[20px] items-center mt-[25px] rounded-[10px]">
                        @forelse ($data->ownedAuctions as $item)
                        <div class="flex">
                            <x-bid-card ref="{{ route('auctions.show', $item->id) }}" img="{{ $item->image_url }}"
                                title="{{ $item->title }}" price="{{ $item->top_bid_amount }}"
                                endsAt="{{ $item->ends_at }}">
                            </x-bid-card>
                        </div>
                        @empty
                        <p class="flex items-center">No Auctions</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="tab-account" class="hidden py-4 sm:px-4 px-0 min-h-[50vh]">
                <div class="flex my-5 items-center">
                    <h3 class="flex flex-col gap-4 font-semibold w-[10rem] max-w-[50%]">Name</h3>
                    <p class="text-black/70 max-w-[50%]">{{ $data->user->name }}</p>
                </div>
                <div class="flex my-5 items-center">
                    <h3 class="flex flex-col gap-4 font-semibold w-[10rem] max-w-[50%]">Username</h3>
                    <p class="text-black/70 max-w-[50%]">{{ $data->user->username }}</p>
                </div>
                <div class="flex my-5 items-center">
                    <h3 class="flex flex-col gap-4 font-semibold w-[10rem] max-w-[50%]">Email</h3>
                    <p class="text-black/70 max-w-[50%]">{{ $data->user->email }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="flex items-center">
                        <h3 class="flex flex-col gap-4 font-semibold w-[10rem]">Address</h3>
                        <div class="max-w-[50%] flex items-center gap-2">
                            <p class="text-black/70">{{ $data->user->address }}</p>
                            <button id="editAddressBtn" class="duration-200 text-white rounded-[10px] my-2"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.53999 19.52C4.92999 19.52 4.35999 19.31 3.94999 18.92C3.42999 18.43 3.17999 17.69 3.26999 16.89L3.63999 13.65C3.70999 13.04 4.07999 12.23 4.50999 11.79L12.72 3.09999C14.77 0.929988 16.91 0.869988 19.08 2.91999C21.25 4.96999 21.31 7.10999 19.26 9.27999L11.05 17.97C10.63 18.42 9.84999 18.84 9.23999 18.94L6.01999 19.49C5.84999 19.5 5.69999 19.52 5.53999 19.52ZM15.93 2.90999C15.16 2.90999 14.49 3.38999 13.81 4.10999L5.59999 12.81C5.39999 13.02 5.16999 13.52 5.12999 13.81L4.75999 17.05C4.71999 17.38 4.79999 17.65 4.97999 17.82C5.15999 17.99 5.42999 18.05 5.75999 18L8.97999 17.45C9.26999 17.4 9.74999 17.14 9.94999 16.93L18.16 8.23999C19.4 6.91999 19.85 5.69999 18.04 3.99999C17.24 3.22999 16.55 2.90999 15.93 2.90999Z"
                                        fill="#5B86AC" />
                                    <path
                                        d="M17.3399 10.95C17.3199 10.95 17.2899 10.95 17.2699 10.95C14.1499 10.64 11.6399 8.26997 11.1599 5.16997C11.0999 4.75997 11.3799 4.37997 11.7899 4.30997C12.1999 4.24997 12.5799 4.52997 12.6499 4.93997C13.0299 7.35997 14.9899 9.21997 17.4299 9.45997C17.8399 9.49997 18.1399 9.86997 18.0999 10.28C18.0499 10.66 17.7199 10.95 17.3399 10.95Z"
                                        fill="#5B86AC" />
                                    <path
                                        d="M21 22.75H3C2.59 22.75 2.25 22.41 2.25 22C2.25 21.59 2.59 21.25 3 21.25H21C21.41 21.25 21.75 21.59 21.75 22C21.75 22.41 21.41 22.75 21 22.75Z"
                                        fill="#5B86AC" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form id="editAddressForm" class="my-2 @if (!$errors->any()) hidden @else flex @endif flex-col"
                        method="POST" action="{{ route('profile.updateAddress') }}">
                        @method('PATCH')
                        @csrf
                        <textarea id="address" name="address" type="text" rows="5"
                            class="p-4 font-body text-body bg-gray3 border border-gray-3 rounded-[10px] bg-white"
                            placeholder="New Address">{{ old('address') }}</textarea>
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="bg-primary-blue hover:bg-hover-blue duration-200 text-white px-3 py-2 rounded-[10px] my-2 max-w-[10rem]">Save
                            Address</button>
                    </form>

                </div>
                <div class="flex my-5 items-center">
                    <h3 class="flex flex-col gap-4 font-semibold w-[10rem]">Phone Number</h3>
                    <p class="text-black/70 max-w-[50%]">{{ $data->user->phone_number }}</p>
                </div>
                <div class="flex my-5 items-center">
                    <h3 class="flex flex-col gap-4 font-semibold w-[10rem]">Account Since</h3>
                    <p class="text-black/70 max-w-[50%]">{{ $data->user->created_at }}</p>
                </div>
            </section>
        </div>

    </x-container>
    @push('scripts')
    <script type="text/javascript">
        function showTab(tabId) {
                const tabs = document.querySelectorAll('.py-4');
                tabs.forEach(tab => tab.classList.add('hidden'));

                const tabButtons = document.querySelectorAll('.active-tab');
                tabButtons.forEach(button => button.classList.remove('active-tab'));

                const selectedTab = document.getElementById(tabId);
                selectedTab.classList.remove('hidden');

                event.target.classList.add('active-tab');
            }

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
