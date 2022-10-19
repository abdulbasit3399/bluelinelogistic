<?php

/**
 * Summary.
 * This is global filter in datatable in filter options
 * @see Modules\Users\Http\Filter\UserFilter
 */

if (isset($key) && $key == 'created_at') {
    if (isset($filter['created_at_start']) && $filter['created_at_start'] != '') {
        $query->whereDate('created_at', '>=', date('Y-m-d H:i:s', strtotime($filter['created_at_start'])));
    }
    if (isset($filter['created_at_end']) && $filter['created_at_end'] != '') {
        $query->whereDate('created_at', '<=', date('Y-m-d H:i:s', strtotime($filter['created_at_end'])));
    }
}
