<div class="font-body fixed w-full top-0 z-50">
    <nav class="flex h-16 items-center border-b-[1px] border-gray-3 bg-white">
        <x-container>
            <div class="flex sm:gap-[2.8rem] gap-5 w-full items-center">
                <a href="/">
                    <img src="/bidify_logo/logo_text_blue.svg" class="max-w-[5rem]"></img>
                </a>

                <form class="w-full" method="GET" action="{{ url('/search') }}">
                    <div class="flex bg-[#e9e8e7] rounded-[10px] h-auto pl-7 items-center gap-3">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.438 14.3365H15.3991L15.0309 13.9969C16.3642 12.5176 17.0969 10.6292 17.0955 8.6761C17.0955 7.05902 16.5942 5.47826 15.6549 4.13371C14.7157 2.78915 13.3807 1.7412 11.8188 1.12237C10.2569 0.503543 8.53826 0.341629 6.88016 0.657105C5.22206 0.972582 3.699 1.75128 2.50358 2.89473C1.30816 4.03818 0.494063 5.49502 0.164246 7.08102C-0.16557 8.66703 0.0037036 10.311 0.650662 11.805C1.29762 13.2989 2.39321 14.5759 3.79887 15.4743C5.20454 16.3727 6.85716 16.8522 8.54774 16.8522C10.665 16.8522 12.6112 16.1101 14.1103 14.8774L14.4654 15.2296V16.2233L21.0406 22.5L23 20.6258L16.438 14.3365ZM8.54774 14.3365C5.2733 14.3365 2.63008 11.8082 2.63008 8.6761C2.63008 5.54403 5.2733 3.01573 8.54774 3.01573C11.8222 3.01573 14.4654 5.54403 14.4654 8.6761C14.4654 11.8082 11.8222 14.3365 8.54774 14.3365Z"
                                fill="#ACB5BD" />
                        </svg>

                        <svg width="1" height="27" viewBox="0 0 1 27" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.5" y1="0.5" x2="0.500001" y2="26.5" stroke="#ACB5BD"
                                stroke-linecap="round" />
                        </svg>

                        <input type="search" name="search" placeholder="Search on Bidify"
                            class="w-full py-[0.5rem] bg-transparent
                            focus:outline-none font-body pr-5" />
                    </div>
                </form>

                <div class="sm:hidden visible items-center flex">
                    <button>
                        <img ref={imgRef} src="/dummy/profile-circle.png" class="max-w-[5rem]"></img>
                    </button>
                </div>

                <div class="hidden sm:flex gap-[2.5rem] font-medium">

                    <a href="{{ auth()->check() ? url('/auctions/create') : url('/login') }}"
                        class="duration-200 relative mt-auto mb-auto text-primary-blue font-semibold hover:before:scale-x-100 before:absolute before:origin-top-left before:block before:transition-transform before:duration-[0.3s] before:ease-[ease] before:scale-x-0 before:left-0 before:bottom-0 before:w-full before:h-0.5 before:bg-[#5B86AC]">
                        Sell
                    </a>

                    @if (auth()->check())
                        <div class="flex gap-5 items-center">
                            <a href="" class="font-bold text-primary-blue">
                                <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 8.70833L18.145 9.53167C18.2557 9.6466 18.3885 9.73801 18.5354 9.80045C18.6824 9.86289 18.8403 9.89507 19 9.89507C19.1596 9.89507 19.3176 9.86289 19.4645 9.80045C19.6114 9.73801 19.7442 9.6466 19.855 9.53167L19 8.70833ZM11.0849 25.9983C10.8413 25.798 10.5282 25.7027 10.2143 25.7333C9.90045 25.7638 9.6116 25.9179 9.41129 26.1614C9.21099 26.405 9.11564 26.7181 9.14622 27.032C9.17681 27.3458 9.33082 27.6347 9.57438 27.835L11.0849 25.9983ZM3.70813 21.2341C3.78298 21.3709 3.88405 21.4916 4.00556 21.5894C4.12707 21.6871 4.26665 21.76 4.41632 21.8038C4.566 21.8476 4.72283 21.8615 4.87788 21.8447C5.03292 21.8279 5.18314 21.7808 5.31996 21.7059C5.45677 21.6311 5.57751 21.53 5.67526 21.4085C5.77302 21.287 5.84588 21.1474 5.8897 20.9977C5.93351 20.848 5.94742 20.6912 5.93062 20.5362C5.91382 20.3811 5.86665 20.2309 5.79179 20.0941L3.70813 21.2341ZM4.35413 14.4669C4.35413 11.0628 6.27788 8.20642 8.90463 7.00467C11.457 5.83775 14.8865 6.1465 18.145 9.53167L19.855 7.88658C15.9916 3.86967 11.5013 3.20625 7.91663 4.845C4.41113 6.44892 1.97913 10.1729 1.97913 14.4669H4.35413ZM13.4535 30.875C14.2658 31.5147 15.1366 32.1955 16.0185 32.7117C16.9005 33.2263 17.9075 33.6458 19 33.6458V31.2708C18.5091 31.2708 17.9328 31.0808 17.2171 30.6613C16.4999 30.2433 15.7573 29.6669 14.9245 29.0098L13.4535 30.875ZM24.5464 30.875C26.8042 29.0938 29.6922 27.0544 31.9564 24.5037C34.2633 21.907 36.0208 18.6881 36.0208 14.4669H33.6458C33.6458 17.9455 32.2208 20.6277 30.1815 22.9267C28.0994 25.27 25.4758 27.1177 23.0755 29.0098L24.5464 30.875ZM36.0208 14.4669C36.0208 10.1729 33.5904 6.44892 30.0833 4.845C26.4986 3.20625 22.0115 3.86967 18.145 7.885L19.855 9.53167C23.1135 6.14808 26.543 5.83775 29.0953 7.00467C31.722 8.20642 33.6458 11.0612 33.6458 14.4669H36.0208ZM23.0755 29.0098C22.2426 29.6669 21.5 30.2433 20.7828 30.6613C20.0671 31.0793 19.4908 31.2708 19 31.2708V33.6458C20.0925 33.6458 21.0995 33.2263 21.9814 32.7117C22.8649 32.1955 23.7341 31.5147 24.5464 30.875L23.0755 29.0098ZM14.9245 29.0098C13.6641 28.0171 12.3832 27.0671 11.0849 25.9983L9.57438 27.835C10.8885 28.9164 12.2787 29.9488 13.4535 30.875L14.926 29.0098H14.9245ZM5.79179 20.0957C4.838 18.3737 4.34294 16.4354 4.35413 14.4669H1.97913C1.97913 17.0604 2.64413 19.2897 3.70813 21.2341L5.79179 20.0941V20.0957Z"
                                        fill="#5B86AC" />
                                </svg>
                            </a>
                            <button id="toggleButton">
                                <img ref={imgRef} src="/dummy/profile-circle.png" class="max-w-[5rem]"></img>
                            </button>
                        </div>
                    @else
                        <a href="{{ url('login') }}"
                            class="duration-200 relative mt-auto mb-auto text-primary-blue font-semibold hover:before:scale-x-100 before:absolute before:origin-top-left before:block before:transition-transform before:duration-[0.3s] before:ease-[ease] before:scale-x-0 before:left-0 before:bottom-0 before:w-full before:h-0.5 before:bg-[#5B86AC]">
                            Login
                        </a>
                    @endif

                </div>
            </div>
        </x-container>
    </nav>
    <div id="containerNav" class="hidden duration-300">
        <x-container>
            <div
                class="bg-white/80 backdrop-blur-md shadow-md absolute flex flex-col top-1 lg:right-16 right-5 rounded-[10px] px-3 py-2 gap-2 justify-between transition-all duration-300 z-[1000]">
                <a to=""
                    class="px-3 py-2 font-bold hover:bg-primary-blue hover:text-white hover:rounded-[5px] text-center cursor-pointer">
                    Account
                </a>

                <div class="border-b border-gray-3"></div>

                <a href="{{ route('auth.logout') }}"
                    class="flex gap-2 items-center justify-center px-3 py-2 hover:bg-red-600 hover:text-white hover:rounded-[5px] font-medium text-red-500 cursor-pointer">
                    Log Out
                </a>
            </div>
        </x-container>
    </div>
</div>
