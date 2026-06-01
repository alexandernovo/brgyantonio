<style>
    @if (Auth::user() && Auth::user()->type == 'admin')
        .data_table th:last-child,
        .data_table td:last-child {
            display: none;
        }
    @endif
</style>
