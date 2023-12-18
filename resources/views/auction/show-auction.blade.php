<x-layout>
    <x-container>
        <div class="mt-[98px] font-body">
            {{ Breadcrumbs::render('auction', $auction) }}
        </div>

        <section class="mt-[35px] grid grid-cols-1 justify-between lg:grid-cols-2 xl:gap-0 gap-10">
            <div class="justify-self-center md:justify-self-start">
                <img src="{{ $auction->image_url }}" class="md:h-[500px] md:w-[500px] h-full w-full object-cover"
                    alt="" />
            </div>

            <div class="justify-self-center md:justify-self-start font-body w-full">
                <div class="flex flex-col gap-1 text-body">
                    <div class="w-full flex justify-between xl:items-center xl:flex-row flex-col">
                        <h1 class="text-[1.25rem] flex justify-start items-start font-semibold">
                            {{ $auction->title }}
                        </h1>
                        @auth()
                        @if (auth()->user()->id === $auction->seller_id)
                        <form action="/auctions/{{ $auction->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                class="text-red-600 hover:bg-red-500 hover:text-white rounded-md p-2 duration-200">Cancel
                                Auction</button>
                        </form>
                        @endif
                        @endauth
                    </div>

                    <p class="text-gray-3">By</p>
                    <p>{{ $auction->seller->username }}</p>
                </div>


                <div
                    class="mt-[25px] border border-gray-3 rounded-[10px] p-[20px] w-full flex flex-col gap-[20px] font-medium">
                    <div class="flex justify-around flex-col gap-5 sm:flex-row">
                        <div>
                            <h3>Current Bid</h3>
                            <p class="font-bold">@money($auction->top_bid_amount)</p>
                        </div>
                        @auth()
                        @if (auth()->user()->id === $auction->seller_id)
                        <div>
                            <h3>Current Buy Now Price</h3>
                            <p class="font-bold">@money($auction->buy_now_price)</p>
                        </div>
                        @endif
                        @endauth

                        <div>
                            <h3>Asking Price</h3>
                            <p>@money($auction->asking_price)</p>
                        </div>
                    </div>

                    <div class="text-black/60 font-medium">
                        <h3 class="text-detail">Time Left</h3>
                        <div class="flex items-center gap-1">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.6147 13.8021C21.6147 18.8333 17.5313 22.9167 12.5001 22.9167C7.46883 22.9167 3.3855 18.8333 3.3855 13.8021C3.3855 8.77083 7.46883 4.6875 12.5001 4.6875C17.5313 4.6875 21.6147 8.77083 21.6147 13.8021Z"
                                    stroke="#0D1321" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path opacity="0.4" d="M12.5 8.33331V13.5416" stroke="#0D1321" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path opacity="0.4" d="M9.375 2.08337H15.625" stroke="#0D1321" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p id="countdown"></p>
                        </div>
                    </div>

                    @auth()
                    @if (auth()->user()->id !== $auction->seller_id)
                    @if($errors->any())
                    <div class="flex flex-col gap-2 my-2">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[10px] relative"
                            role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <span class="block sm:inline"> {{ $errors->first() }} </span>
                        </div>
                    </div>
                    @enderror
                    <div class="grid grid-cols-2 gap-5 items-end">
                        <form action="/auctions/{{ $auction->id }}/bidders" class="grid grid-cols-1 gap-4"
                            method="post">
                            {{-- CSRF Request --}}
                            @csrf
                            <div
                                class="border border-gray-3 sm:h-[63px] h-[54px] rounded-[5px] flex items-center px-[15px] gap-2">
                                <p>Bid: </p>
                                {{-- input bid form --}}
                                <input type="text" value="{{ $minBidAmount }}"
                                    onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;"
                                    name="amount" id="" placeholder="Put Your Bid Here"
                                    class="w-full bg-white focus:outline-none h-full" />
                                <p class="select-none text-xs text-gray-400">Minimal of 10% from the current bid:
                                    @money($minBidAmount)</p>
                            </div>
                            <button
                                class="py-[15px] h-full border border-gray-3 rounded-[5px] hover:bg-gray-3 duration-200">
                                Place Bid
                            </button>
                        </form>

                        <form class="grid grid-cols-1 gap-4 text-subtitle font-bold" method="">
                            <div>
                                <h1>Buy Now</h1>
                                <h1 class="sm:text-title_02 font-bold">@money($auction->buy_now_price)</h1>
                            </div>

                            <button
                                class="py-[15px] h-full rounded-[3px] text-white bg-primary-blue hover:bg-light-blue duration-200">
                                Buy Now
                            </button>
                        </form>
                    </div>
                    @endif
                    @endauth
                </div>


                <div class="mt-[25px] flex flex-col gap-1 text-body">
                    <div class="flex items-center gap-2">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.6147 13.8021C21.6147 18.8333 17.5313 22.9167 12.5001 22.9167C7.46883 22.9167 3.3855 18.8333 3.3855 13.8021C3.3855 8.77083 7.46883 4.6875 12.5001 4.6875C17.5313 4.6875 21.6147 8.77083 21.6147 13.8021Z"
                                stroke="#2D953D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M12.5 8.33331V13.5416" stroke="#2D953D" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M9.375 2.08331H15.625" stroke="#2D953D" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <div class="flex gap-2">
                            <p>Start&nbsp;&nbsp; : </p>
                            <p>{{ $auction->created_at }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.6147 13.8021C21.6147 18.8333 17.5313 22.9167 12.5001 22.9167C7.46883 22.9167 3.3855 18.8333 3.3855 13.8021C3.3855 8.77083 7.46883 4.6875 12.5001 4.6875C17.5313 4.6875 21.6147 8.77083 21.6147 13.8021Z"
                                stroke="#FF5656" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M12.5 8.33331V13.5416" stroke="#FF5656" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M9.375 2.08331H15.625" stroke="#FF5656" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <div class="flex gap-2">
                            <p>End&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </p>
                            <p>{{ $auction->ends_at }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mt-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.67313 4.60615C5.44985 4.50579 5.19586 4.49824 4.96701 4.58514C4.73817 4.67204 4.55321 4.84628 4.45282 5.06953L2.4562 9.50307C2.35573 9.72612 2.34791 9.97992 2.43445 10.2087C2.52098 10.4375 2.69481 10.6226 2.91774 10.7234L4.29313 11.3428C4.40362 11.3927 4.52285 11.4203 4.64403 11.4241C4.7652 11.4279 4.88594 11.4078 4.99934 11.365C5.11274 11.3221 5.2166 11.2573 5.30496 11.1743C5.39333 11.0913 5.46448 10.9917 5.51436 10.8812L7.51097 6.44677C7.61144 6.22372 7.61927 5.96991 7.53273 5.7411C7.44619 5.51229 7.27236 5.32719 7.04943 5.22646L5.67405 4.60707M4.03743 10.0781C4.11271 10.1121 4.19394 10.1309 4.27647 10.1334C4.35901 10.136 4.44124 10.1222 4.51847 10.093C4.5957 10.0638 4.66642 10.0196 4.72658 9.96307C4.78675 9.90651 4.83518 9.83866 4.86913 9.76338C4.90307 9.6881 4.92185 9.60688 4.9244 9.52434C4.92695 9.4418 4.91322 9.35957 4.88399 9.28234C4.85476 9.20511 4.81061 9.1344 4.75405 9.07423C4.69749 9.01407 4.62963 8.96563 4.55436 8.93169C4.40233 8.86314 4.22929 8.85779 4.07332 8.91682C3.91735 8.97585 3.79121 9.09443 3.72266 9.24646C3.65412 9.39849 3.64877 9.57152 3.7078 9.72749C3.76683 9.88347 3.8854 10.0096 4.03743 10.0781ZM19.8599 10.8443C19.9732 10.8013 20.077 10.7364 20.1653 10.6532C20.2535 10.5701 20.3245 10.4704 20.3742 10.3598C20.424 10.2492 20.4514 10.13 20.455 10.0088C20.4586 9.88758 20.4383 9.76687 20.3953 9.65353L18.6737 5.1083C18.6308 4.99487 18.5659 4.89101 18.4829 4.80266C18.3998 4.71431 18.3001 4.64319 18.1895 4.59339C18.0789 4.54358 17.9596 4.51606 17.8384 4.51239C17.7171 4.50872 17.5964 4.52897 17.483 4.572L16.0734 5.10646C15.9601 5.14948 15.8563 5.21441 15.7681 5.29753C15.6798 5.38066 15.6088 5.48036 15.5591 5.59094C15.5094 5.70152 15.4819 5.82081 15.4783 5.94199C15.4747 6.06318 15.495 6.18389 15.5381 6.29723L17.2605 10.8434C17.3472 11.0722 17.5213 11.2573 17.7444 11.3579C17.9675 11.4584 18.2215 11.4663 18.4504 11.3797L19.8608 10.8452M17.1497 5.81907C17.0725 5.84835 17.0018 5.89254 16.9417 5.94914C16.8816 6.00574 16.8332 6.07362 16.7993 6.14892C16.7654 6.22423 16.7466 6.30547 16.7441 6.38801C16.7416 6.47055 16.7554 6.55278 16.7847 6.63C16.8139 6.70721 16.8581 6.77791 16.9147 6.83804C16.9713 6.89818 17.0392 6.94658 17.1145 6.98048C17.1898 7.01438 17.2711 7.03312 17.3536 7.03562C17.4361 7.03813 17.5184 7.02435 17.5956 6.99507C17.7515 6.93595 17.8776 6.8173 17.9461 6.66522C18.0145 6.51314 18.0198 6.3401 17.9607 6.18415C17.9015 6.0282 17.7829 5.90213 17.6308 5.83366C17.4787 5.7652 17.3057 5.75995 17.1497 5.81907Z"
                                fill="#5B86AC" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.0476 6.09875H16.055C16.1155 6.09348 16.1743 6.07636 16.2281 6.04836C16.2819 6.02036 16.3296 5.98204 16.3686 5.93558C16.4076 5.88913 16.4371 5.83544 16.4554 5.7776C16.4736 5.71975 16.4803 5.65887 16.475 5.59845C16.4698 5.53802 16.4526 5.47922 16.4246 5.42541C16.3966 5.3716 16.3583 5.32383 16.3119 5.28483C16.2654 5.24583 16.2117 5.21636 16.1539 5.19811C16.096 5.17985 16.0351 5.17317 15.9747 5.17845H15.9673L15.9433 5.18121L15.8547 5.19045C15.3873 5.23486 14.9208 5.28779 14.4553 5.34921C13.6292 5.45721 12.6055 5.62337 11.9353 5.84675C11.6104 5.95475 11.267 6.16429 10.9384 6.40429C10.6052 6.64798 10.26 6.94429 9.92949 7.25168C9.34308 7.80529 8.78278 8.38592 8.25041 8.99168C7.86364 9.42921 7.7741 10.1271 8.22826 10.6218C8.52364 10.9412 8.98518 11.3455 9.58334 11.5264C10.2083 11.7138 10.9283 11.6409 11.664 11.0944L12.5861 10.4991C12.5915 10.4955 12.5971 10.4921 12.6027 10.4889C12.7347 10.5692 12.9184 10.7077 13.1381 10.8914C13.3781 11.0926 13.6384 11.3298 13.8812 11.5578C14.1567 11.8176 14.4275 12.0822 14.6935 12.3517L14.7443 12.4043L14.7572 12.4172L14.7618 12.4218L14.8163 12.4772L14.8855 12.5132C15.2575 12.6978 15.6664 12.6314 15.984 12.5243C16.3144 12.4135 16.643 12.2252 16.9227 12.0397C17.2731 11.8043 17.6049 11.5423 17.915 11.256L17.9316 11.2412L17.9363 11.2366L17.9372 11.2357C17.9372 11.2357 17.856 10.9495 17.5384 10.6154L17.2883 10.9292L17.0769 11.5384L14.7618 12.4218L15.2307 12L14.9833 11.3381C14.8286 11.1858 14.6723 11.035 14.5144 10.8858C14.2652 10.6514 13.9901 10.4012 13.7298 10.1843C13.4778 9.97198 13.2156 9.77075 12.9969 9.65075C12.6332 9.45137 12.2769 9.59906 12.0849 9.72368L11.136 10.3366L11.123 10.3458C10.6107 10.7298 10.1898 10.7446 9.84918 10.6421C9.47995 10.5314 9.15226 10.2618 8.90764 9.99598C8.83103 9.91291 8.80887 9.75321 8.9418 9.60275C9.45462 9.01953 9.99428 8.46047 10.559 7.92737C10.8729 7.63475 11.1886 7.36429 11.483 7.14921C11.784 6.92952 12.0369 6.78645 12.228 6.72275C12.804 6.53075 13.7464 6.37291 14.5763 6.26306C15.0301 6.20341 15.4849 6.15202 15.9406 6.10891L16.0264 6.1006L16.0476 6.09875Z"
                                fill="#5B86AC" />
                            <path
                                d="M15.3481 11.7019C15.2276 11.5796 15.106 11.4584 14.9835 11.3382L15.2309 12L14.762 12.4219L17.077 11.5385L17.2884 10.9292L17.5386 10.6154L17.3032 10.5656L17.3004 10.5674L17.2875 10.5794L17.2377 10.6256C16.9775 10.8595 16.7015 11.0751 16.4115 11.2708C16.1623 11.4369 15.9103 11.5754 15.6887 11.6492C15.517 11.7074 15.41 11.712 15.3481 11.7019Z"
                                fill="#5B86AC" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.96653 6.98586L6.78469 6.56124L6.60284 6.13663L6.63977 6.12186L6.74407 6.07755C7.25584 5.86024 7.76971 5.64792 8.28561 5.44063C8.70458 5.27148 9.12682 5.11053 9.55207 4.95786C9.73946 4.8914 9.91392 4.83416 10.0598 4.79263C10.1853 4.75663 10.3459 4.71509 10.477 4.71509C10.597 4.71509 10.7235 4.74278 10.8278 4.77047C10.9404 4.80093 11.0641 4.84155 11.1896 4.8877C11.4425 4.98001 11.7278 5.10001 11.9918 5.21632C12.2997 5.35394 12.605 5.49735 12.9075 5.64647L12.9684 5.67601L12.985 5.68432L12.9905 5.68709C13.1001 5.7418 13.1834 5.8378 13.2222 5.95396C13.261 6.07011 13.252 6.19692 13.1973 6.30647C13.1426 6.41603 13.0466 6.49936 12.9304 6.53814C12.8143 6.57691 12.6875 6.56796 12.5779 6.51324L12.5733 6.51047L12.5585 6.50309L12.5013 6.4754C12.2088 6.33152 11.9137 6.19303 11.6161 6.06001C11.3724 5.95033 11.1252 5.84873 10.8748 5.7554C10.7811 5.7206 10.686 5.6898 10.5896 5.66309C10.5536 5.65269 10.5169 5.64467 10.4798 5.63909L10.4715 5.64093C10.453 5.6437 10.4041 5.65386 10.3127 5.6797C10.1599 5.72483 10.0084 5.77439 9.85853 5.82832C9.50038 5.95478 9.06007 6.12555 8.629 6.29816C8.11886 6.50248 7.61083 6.71203 7.105 6.92678L7.00253 6.97016L6.96653 6.98586ZM6.36007 6.74309C6.31203 6.63059 6.31061 6.50362 6.35613 6.39008C6.40166 6.27653 6.49039 6.1857 6.60284 6.13755L6.78469 6.56217L6.96653 6.98586C6.91078 7.00979 6.85085 7.02249 6.79018 7.02324C6.72952 7.02399 6.66929 7.01277 6.61297 6.99022C6.55664 6.96767 6.50531 6.93424 6.46191 6.89183C6.41852 6.84943 6.38391 6.79888 6.36007 6.74309ZM4.60346 10.3985C4.64509 10.3544 4.695 10.319 4.75033 10.2942C4.80566 10.2694 4.86534 10.2557 4.92594 10.254C4.98655 10.2523 5.04689 10.2626 5.10354 10.2842C5.16019 10.3058 5.21202 10.3384 5.25607 10.38L4.93853 10.7151L4.62192 11.0511C4.57784 11.0095 4.5424 10.9595 4.51762 10.9042C4.49283 10.8489 4.47919 10.7892 4.47748 10.7286C4.47577 10.668 4.48601 10.6077 4.50762 10.551C4.52924 10.4944 4.5618 10.4425 4.60346 10.3985ZM8.82192 13.5249L11.3724 14.4812C11.6213 14.5745 11.8918 14.5942 12.1515 14.5378C12.4113 14.4815 12.6494 14.3517 12.8373 14.1637L14.7665 12.2345C14.8532 12.1479 14.9707 12.0994 15.0932 12.0994C15.2156 12.0995 15.3331 12.1483 15.4196 12.2349C15.5062 12.3216 15.5547 12.4391 15.5546 12.5616C15.5546 12.684 15.5058 12.8015 15.4192 12.888L13.4899 14.8172C13.1765 15.1303 12.7797 15.3465 12.3468 15.4402C11.9138 15.5338 11.4631 15.5008 11.0484 15.3452L8.4453 14.3695L8.42407 14.3594C8.28292 14.2811 8.14888 14.1906 8.02346 14.0889C7.87392 13.9745 7.69853 13.8305 7.5093 13.6699C7.08557 13.3077 6.66767 12.9387 6.25577 12.5631C5.7524 12.1059 5.253 11.6443 4.75761 11.1785L4.657 11.0843L4.62192 11.0511L4.93853 10.7151L5.25607 10.38L5.29023 10.4123L5.389 10.5055C5.88057 10.9675 6.37597 11.4254 6.87515 11.8791C7.29977 12.264 7.73823 12.6545 8.10561 12.9665C8.29023 13.1225 8.45361 13.2554 8.58561 13.3579C8.70746 13.4511 8.78407 13.5028 8.82192 13.524M5.69546 15.4966C5.77393 15.4031 5.88628 15.3444 6.00791 15.3335C6.12953 15.3226 6.25053 15.3603 6.34438 15.4385L7.22961 16.1769C7.42799 16.3426 7.66876 16.4494 7.92469 16.4852L9.06561 16.6459C9.12699 16.6526 9.18639 16.6716 9.24031 16.7017C9.29422 16.7318 9.34154 16.7724 9.37947 16.8211C9.4174 16.8698 9.44518 16.9257 9.46114 16.9853C9.4771 17.045 9.48094 17.1072 9.47241 17.1684C9.46389 17.2295 9.44318 17.2883 9.41151 17.3414C9.37984 17.3944 9.33786 17.4405 9.28805 17.477C9.23824 17.5135 9.18161 17.5396 9.12152 17.5538C9.06144 17.568 8.99911 17.57 8.93823 17.5597L7.79638 17.4C7.36981 17.3401 6.96852 17.162 6.63792 16.8859L5.75269 16.1474C5.70609 16.1085 5.66761 16.0608 5.63946 16.0071C5.61131 15.9533 5.59404 15.8945 5.58864 15.8341C5.58324 15.7736 5.58981 15.7127 5.60798 15.6548C5.62615 15.5969 5.65649 15.5431 5.69546 15.4966Z"
                                fill="#5B86AC" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.5385 22.1538C17.4009 22.1538 22.1538 17.4009 22.1538 11.5385C22.1538 5.676 17.4009 0.923077 11.5385 0.923077C5.676 0.923077 0.923077 5.676 0.923077 11.5385C0.923077 17.4009 5.676 22.1538 11.5385 22.1538ZM11.5385 23.0769C17.9114 23.0769 23.0769 17.9114 23.0769 11.5385C23.0769 5.16554 17.9114 0 11.5385 0C5.16554 0 0 5.16554 0 11.5385C0 17.9114 5.16554 23.0769 11.5385 23.0769Z"
                                fill="#5B86AC" />
                        </svg>


                        <p class="font-bold">Winner:
                            {{ $auction->winner ? $auction->winner->username : 'No winner yet' }}</p>
                    </div>
                </div>

                <div class="mt-[25px] border-b border-gray-3"></div>

                <div>
                    <h1 class="text-title_02 my-[25px]">Current Bids</h1>
                    <div class="flex justify-center flex-col">
                        <div class="border-b border-gray-3"></div>
                        <div class="py-5 px-3 grid grid-cols-4 text-black/50 font-medium">
                            <p class="col-span-2">Bidder</p>
                            <p>Bid Price</p>
                            <p>Date</p>
                        </div>
                        <div class="border-b border-gray-3"></div>
                    </div>
                    <div class="max-h-[15rem] overflow-y-auto">
                        @foreach ($auction->bids->sortByDesc('created_at') as $bid)
                        <div class="flex justify-center flex-col">
                            <div class="py-5 px-3 grid grid-cols-4 text-black font-medium">
                                <p class="col-span-2"> {{ $bid->user->name }}</p>
                                <p>@money($bid->amount)</p>
                                <p title="{{ $bid->created_at }}">{{ $bid->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="border-b border-gray-3"></div>
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="mt-[25px] border-b border-gray-3"></div>

                <div>
                    <h1 class="text-title_02 my-[25px]">Description</h1>
                    <p>
                        {{ $auction->description }}
                    </p>
                </div>
            </div>
        </section>
    </x-container>

</x-layout>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the target date and time in milliseconds
        const targetDate = new Date("{{ $auction->ends_at }}").getTime();

        // Function to calculate and update the countdown
        function updateCountdown() {
            const currentTime = new Date().getTime();
            const timeDifference = Math.max(targetDate - currentTime, 0);

            // Calculate days, hours, minutes, and seconds
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Format the remaining time
            const remainingTime = `${days} Days | ${hours}:${minutes}:${seconds}`;

            // Update the countdown element
            document.getElementById("countdown").innerText = remainingTime;
        }

        // Initial update
        updateCountdown();

        // Update the countdown every second
        setInterval(updateCountdown, 1000);
    });
</script>
