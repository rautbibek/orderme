<div class="card">
    <div class="card-header p-1 flex-between">
        <div>
            <label class="for-hover-lable" style="cursor: pointer"
            >
                <a href="{{route('category', $category->slug)}}" style="text-decoration: none">{{$category->name}}</a>
            </label>
        </div>
        @if (count($category->children) > 0)
        <div>
            <strong class="pull-right for-brand-hover" style="cursor: pointer"
                    onclick="$('#collapse-{{$category->id}}').toggle(400)">
                +
            </strong>
        </div>
        @endif
    </div>
    @if (count($category->children) > 0)
    <div class="card-body ml-2" id="collapse-{{$category->id}}" style="display: none;">
        @foreach ($category->children as $sub)
            @include('themes.molla.template.subcategory', ['category' => $sub])
        @endforeach
    </div>
    @endif
</div>
