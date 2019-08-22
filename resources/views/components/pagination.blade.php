@if ($list->lastPage() > 1)

    <div id="dataTable-table" class="dataTables_wrapper mt-3">
        <div class="dataTables_paginate paging_simple_numbers" id="datatable2_paginate">

            <a class="paginate_button previous {{ ($list->currentPage() == 1) ? 'disabled' : '' }}"
               href="{{ $list->url(1) }}">Назад</a>

            <span>
                @for ($i = 1; $i <= $list->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($linkLimit / 2);
                    $from = $list->currentPage() - $half_total_links;
                    $to = $list->currentPage() + $half_total_links;
                    if ($list->currentPage() < $half_total_links) {
                        $to += $half_total_links - $list->currentPage();
                    }
                    if ($list->lastPage() - $list->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($list->lastPage() - $list->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        <a class="paginate_button {{ ($list->currentPage() == $i) ? 'current' : '' }}"
                           href="{{ $list->url($i) }}">{{ $i }}
                        </a>
                    @endif
                @endfor
            </span>

            <a class="paginate_button next {{ ($list->currentPage() == $list->lastPage()) ? 'disabled' : '' }}"
               href="{{ $list->url($list->lastPage()) }}">Вперед</a>
        </div>
    </div>
@endif
