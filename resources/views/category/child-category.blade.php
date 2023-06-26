<li class="list-group-item">
    @if(isset($cat))

        <input name="checkboxes" type="{{ $type }}" data-id="{{ $child_category->id }}" {{  $cat->parent_id == $childCategory->id ? "checked" : '' }} class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"/>

    @elseif(isset($product_cats))

        <input name="checkboxes" type="{{ $type }}" data-id="{{ $child_category->id }}" {{ in_array($child_category->id, $product_cats) ? "checked" : ''}} class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"/>

    @else

        <input name="checkboxes" type="{{ $type }}" data-id="{{ $child_category->id }}" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"/>

    @endif
    <span style="margin-left: 10px">{{ $child_category->name }}</span>
</li>
@if ($child_category->categories)
    <ul style="margin-left: 40px" class="list-group">
        @foreach ($child_category->categories as $childCategory)
            @if(isset($cat))

                @include('category/child-category', ['child_category' => $childCategory , 'cat' => $cat])

            @elseif(isset($product_cats))

                @include('category/child-category', ['child_category' => $childCategory, 'product_cats' => $product_cats])

            @else

                @include('category/child-category', ['child_category' => $childCategory])

            @endif
        @endforeach
    </ul>
@endif