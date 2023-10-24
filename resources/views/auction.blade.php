
@foreach ($data as $item)
    
    <h1>{{ $item->seller->username}}</h1>
    <h1>{{ $item->title }}</h1>


@endforeach