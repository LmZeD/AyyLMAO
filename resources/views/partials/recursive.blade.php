<li>{{ $category['title'] }}</li>
@if (count($category->getChildren) > 0)
    <ul>
        @foreach($category->getChildren as $category)
            @include('partials.recursive', $category)
        @endforeach
    </ul>
@endif