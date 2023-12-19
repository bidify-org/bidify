@props(['ref'])

<div class="flex items-center font-body text-subtitle">
    <a href={{ $ref }}
        class="duration-200 relative mt-auto mb-auto text-primary-blue hover:before:scale-x-100 before:absolute before:origin-top-left before:block before:transition-transform before:duration-[0.3s] before:ease-[ease] before:scale-x-0 before:left-0 before:bottom-0 before:w-full before:h-0.5 before:bg-[#5B86AC]">
        <p>See More</p>
    </a>
    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.5 12.5H17.5M17.5 12.5L12.9118 8.5M17.5 12.5L12.9118 16.5" stroke="#5B86AC" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</div>
