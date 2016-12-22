@foreach($items as $item)
    <li {!! $item->attributes() !!} @if($item->hasChildren()) class="dropdown"@endif>
        @if($item->link) 
            @if($item->hasChildren())
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ $item->url() }}">
            @else 
            <a class="nav-link" href="{{ $item->url() }}">
            @endif 
                {!! $item->title !!}
            @if($item->hasChildren()) <b class="caret"></b> @endif
            </a>
        @else
            {{$item->title}}
        @endif
        @if($item->hasChildren())
            <ul class="dropdown-menu">
                @foreach($item->children() as $child)
                    <li class="nav-item"><a class="nav-link" href="{{ $child->url() }}">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
    @if($item->divider)
        <li{{\HTML::attributes($item->divider)}}></li>
    @endif
@endforeach