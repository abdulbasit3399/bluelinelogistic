<?php

namespace Modules\Cargo\Http\Filter;


/**
 * Use this class to add filter on users in query database.
 */
class MissionFilter
{

    /**
     * user query.
     * @var object
     */
    public $query;

    /**
     * request data.
     * @var object
     */
    public $request;


    public function __construct($query, $request)
    {
        $this->query = $query;
        $this->request = $request;

        return $this;
    }

    /**
     * request data.
     * @param array $key_filters {
     * @item string
     * }
     * @return query
     */
    public function filterBy(...$key_filters)
    {
        $filter = $this->request->filter;
        $query = $this->query;

        if ($filter) {
            $filter_array = is_array($key_filters[0]) ? $key_filters[0] : $key_filters;
            foreach ($filter_array as $key) {
                // check on created_at | filter table


                // status
                if ($key == 'status_id') {
                    if (isset($filter['status_id']) && $filter['status_id'] != '')
                    {
                        $query->where('status_id', $filter['status_id']);
                    };
                }


                // type
                if ($key == 'type') {
                    if (isset($filter['type']) && $filter['type'] != '')
                    {
                        $query->where('type', $filter['type']);
                    };
                }

                // captain_id
                if ($key == 'captain_id') {
                    if (isset($filter['captain_id']) && $filter['captain_id'] != '')
                    {
                        $query->where('captain_id', $filter['captain_id']);
                    };
                }





                require app_path('Helpers/globalFilter/created_at.php');
            }
        }

        return $query;
    }
}