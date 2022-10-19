<?php

namespace Modules\Cargo\Http\Filter;


/**
 * Use this class to add filter on users in query database.
 */
class ClientAddressFilter
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

            //  address
            if ($key == 'address') {
                if (isset($filter['address']) && $filter['address'] != '') {
                    $query->where('address', $filter['address']);
                }
            }

            //  country_id
            if ($key == 'country_id') {
                if (isset($filter['country_id']) && $filter['country_id'] != '') {
                    $query->where('country_id', $filter['country_id']);
                }
            }

            //  area_id
            if ($key == 'area_id') {
                if (isset($filter['area_id']) && $filter['area_id'] != '') {
                    $query->where('area_id', $filter['area_id']);
                }
            }

             //  state_id
            if ($key == 'state_id') {
                if (isset($filter['state_id']) && $filter['state_id'] != '') {
                    $query->where('state_id', $filter['state_id']);
                }
            }

                require app_path('Helpers/globalFilter/created_at.php');
            }
        }

        return $query;
    }
}
