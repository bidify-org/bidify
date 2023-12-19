<x-layout title="Bidify Register">
    <div class="mt-28 mb-16 flex justify-center items-center h-screen">
        <div class=" bg-[#fff] flex flex-col px-[43px] py-[50px] w-[503px] max-w-lg  rounded-[40px]">
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf
                <div class="flex flex-col mb-[36px]">
                    <h3 class="font-body text-main_03">Register</h3>
                    <p class="font-body text-detail">
                        Already have an account?
                        <a class="text-primary-blue" href="{{ route('auth.loginForm') }}">
                            Login
                        </a>
                    </p>
                </div>
                @error('message')
                <div class="flex flex-col gap-2 my-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-[10px] relative"
                        role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline"> {{ $errors->first() }} </span>
                    </div>
                </div>
                @enderror
                <div>
                    <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                        <label class="font-body text-body text-primary-blue">
                            Username
                        </label>
                        <input name="username" type="text" placeholder="johndoe"
                            class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white"
                            value="{{ old('username') }}" />
                        @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                        <label class="font-body text-body text-primary-blue">
                            Name
                        </label>
                        <input name="name" type="text" placeholder="John Doe"
                            class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white"
                            value="{{ old('name') }}" />
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col flex-start gap-[1px] my-[15px]">
                        <label class="font-body text-body text-primary-blue">
                            Email
                        </label>
                        <input name="email" type="email" placeholder="johndoe@mail.com"
                            class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white"
                            value="{{ old('email') }}" />
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col flex-start gap-[1px] my-[15px] ">
                        <label class=" font-body text-body text-primary-blue">
                            Password
                        </label>
                        <input name="password" type="password"
                            class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white" />
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col flex-start gap-[1px] my-[15px] ">
                        <label class=" font-body text-body text-primary-blue">
                            Confirm Password
                        </label>
                        <input name="password_confirmation" type="password"
                            class="pl-4 font-body text-body bg-gray3 border border-gray-3 h-[39px] rounded-[10px] bg-white" />
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col justify-around gap-2 my-[36px]">
                    <button
                        class="flex justify-center items-center h-[52px] disabled:opacity-75 font-body text-body text-white bg-primary-blue py-2  hover:bg-hover-blue rounded-lg duration-100">
                        Register
                    </button>
                </div>
                <div class="flex justify-center items-center gap-2 my-[36px]">
                    <div class="w-full border-b border-gray-400"></div>
                    <p class="flex flex-start font-body text-smallest text-gray-3">
                        Or
                    </p>
                    <div class="w-full border-b border-gray-400"></div>
                </div>
                <div class="flex flex-col flex-start gap-2 my-4">
                    <a href="/auth/google/redirect"
                        class="flex justify-center items-center h-[52px] font-body text-body text-black border-[1px] border-primary-blue rounded-[10px] bg-white">
                        <img src="assets/google.svg" class="fill-current w-[30px] h-[30px] mr-2 "></img>
                        <span class="font-body text-detail">
                            Sign Up with Google
                        </span>
                    </a>
                    <a href="/auth/github/redirect"
                        class="flex justify-center items-center h-[52px] font-body text-body text-black border-[1px] border-primary-blue rounded-[10px] bg-white">
                        <img src="assets/github.svg" class="fill-current w-[30px] h-[30px] mr-2 "></img>
                        <span class="font-body text-detail">
                            Sign Up with GitHub
                        </span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
