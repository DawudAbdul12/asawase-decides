<nav aria-label="Page navigation example">
    @if ($paginator->hasPages())
    <ul class="pagination">
    
        @if ($paginator->onFirstPage())
            <li class="page-item">  <a class="disabled page-link"> Previous </a> </li>
        @else
            <li class="page-item"> <a href="{{ $paginator->previousPageUrl() }}" class="page-link"> Previous </a>
        @endif


    
        @foreach ($elements as $element)
        
            @if (is_string($element))
              <li class="page-item">  <a class="disabled">{{ $element }}</a> </li>
            @endif


        
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                       <li class="page-item active"> <a class=" page-list">{{ $page }}</a></li>
                    @else
                        <li class="page-item"> <a href="{{ $url }}" class="page-list">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
           <li class="page-item"> <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-list">Next →</a> </li>
        @else
           <li class="page-item"> <a class="disabled page-list">Next </a></li>
        @endif
    </ul>
    @endif 
</nav>