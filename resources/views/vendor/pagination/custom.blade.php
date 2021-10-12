@if ($paginator->hasPages())
<ul class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <li class="disabled">
      <a href="javascript:void(0);">
        <i class="material-icons">chevron_left</i>
      </a>
    </li>
  @else
    <li>
      <a href="{{ $paginator->previousPageUrl() }}">
        <i class="material-icons">chevron_left</i>
      </a>
    </li>
  @endif

  {{-- Pagination Elements --}}
  @foreach ($elements as $element)
  {{-- "Three Dots" Separator --}}
    @if (is_string($element))
      <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
          <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
        @else
        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
          <li><a href="{{ $url }}" class="waves-effect">{{ $page }}</a></li>
        @endif
      @endforeach
    @endif
  @endforeach

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <li>
      <a href="{{ $paginator->nextPageUrl() }}" class="waves-effect">
        <i class="material-icons">chevron_right</i>
      </a>
    </li>
  @else
    <li class="disabled">
      <a href="javascript:void(0);" class="waves-effect">
        <i class="material-icons">chevron_right</i>
      </a>
    </li>
  @endif
</ul>
@endif
