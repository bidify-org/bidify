@unless ($breadcrumbs->isEmpty())
    <ol class="flex gap-5 font-body text-base items-center">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item flex gap-1 items-center">
                    <a class="hover:text-white p-2 rounded-md hover:bg-primary-blue duration-200"
                        href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    <div>/</div>
                </li>
            @else
                <li class="breadcrumb-item active text-primary-blue">{{ $breadcrumb->title }} </li>
            @endif
        @endforeach
    </ol>
@endunless
