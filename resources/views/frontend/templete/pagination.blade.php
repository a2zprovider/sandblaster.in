<!-- Techmax Pagination Start -->
<div class="techmax-pagination">

    @if($paginator->hasPages())
    @if ($paginator->lastPage() > 1)
    @php
    $link_limit = 10;
    $query = [];
    $query_array = [];
    foreach( $query as $key => $key_value ){
    if($key!='page'){
    $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
    }
    }
    $query = implode( '&', $query_array );
    @endphp
    <nav style="flex-direction: row;" aria-label="Demo of active current page number">
        <!-- <div class="justify-content-start">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of total {{$paginator->total()}} entries</div> -->
        <ul class="pagination pagination-part justify-content-center">
            <!-- <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1).'&'.$query }}">First</a>
            </li> -->
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1).'&'.$query }}"><</a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                    $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to) <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $paginator->url($i).'&'.$query }}">{{ $i }}</a>
                    </li>
                    @endif
                    @endfor
                    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1).'&'.$query }}">></a>
                    </li>
                    <!-- <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()).'&'.$query }}">Last</a>
                    </li> -->
        </ul>
    </nav>
    @endif
    @endif

</div>
<!-- Techmax Pagination End -->