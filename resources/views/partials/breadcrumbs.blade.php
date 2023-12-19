@unless ($breadcrumbs->isEmpty())
    <ol class="flex gap-2 font-body text-base items-center">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item flex items-center justify-between">
                    <a class="hover:text-white p-2 rounded-md hover:bg-primary-blue duration-200"
                        href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.3">
                        <path
                            d="M6.68262 14.9401L11.5726 10.0501C12.1501 9.47256 12.1501 8.52756 11.5726 7.95006L6.68262 3.06006"
                            stroke="#1D2D44" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </svg>
            @else
                <li class="breadcrumb-item active text-primary-blue whitespace-nowrap truncate">{{ $breadcrumb->title }}
                </li>
            @endif
        @endforeach
    </ol>
@endunless
