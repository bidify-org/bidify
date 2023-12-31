@props(['ref', 'img', 'title', 'price', 'endsAt'])

<a href="{{ $ref }}"
    class="md:w-[13rem] md:max-w-full max-w-[10rem] w-auto min-w-[9rem] h-auto border-solid border-[1px] border-gray-3 rounded-[10px] overflow-clip flex flex-col">
    <img src={{ Storage::url($img) }}
        class="object-cover md:w-[210px] md:h-[210px] w-[160px] h-[160px] aspect-square object-center" alt="" />
    <div class="p-[5px] font-body flex flex-col gap-[10px]">
        <h1 class="text-detail font-medium min-h-[3rem]">{{ Str::limit($title, 40) }}</h1>
        <div>
            <p class="text-smallest text-black/70">At..</p>
            <h1 class="text-body_bold text-dark-blue">@money((int)$price)</h1>
        </div>
        <div class="flex gap-[5px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.2916 11.0417C17.2916 15.0667 14.025 18.3333 9.99998 18.3333C5.97498 18.3333 2.70831 15.0667 2.70831 11.0417C2.70831 7.01667 5.97498 3.75 9.99998 3.75C14.025 3.75 17.2916 7.01667 17.2916 11.0417Z"
                    stroke="#0D1321" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path opacity="0.4" d="M10 6.66666V10.8333" stroke="#0D1321" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path opacity="0.4" d="M7.5 1.66666H12.5" stroke="#0D1321" stroke-width="1.5" stroke-miterlimit="10"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            <p id="countdown_{{ $ref }}" class="text-detail text-black/60"></p>
        </div>
    </div>

    <script>
        @push('scripts')
        triggerCountdown('{{ $endsAt }}', 'countdown_{{ $ref }}');
        @endpush
    </script>
</a>
