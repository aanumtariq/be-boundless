<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" data-toggle="tooltip" title="First Page">
            <a href="{{ $paginator->url(1) }}"><i class="fas fa-arrow-left"></i></a>
         </li>
         <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" data-toggle="tooltip" title="Previous Page">
            <a href="{{ $paginator->url(1) }}"><i class="fas fa-chevron-left"></i></a>
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
            @if ($from < $i && $i < $to)
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" data-toggle="tooltip" title="Next Page">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" ><i class="fas fa-chevron-right"></i></a>
        </li>
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" data-toggle="tooltip" title="Last Page">
            <a href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fas fa-arrow-right"></i></a>
        </li>
    </ul>
@endif