<?php

namespace Modules\Cargo\Http\Filter;


/**
 * Use this class to add filter on users in query database.
 */
class TransactionFilter
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

                // captain
                if ($key == 'captain_id') {
                    if (isset($filter['captain_id']) && $filter['captain_id'] != '') {
                        $query->where('captain_id', $filter['captain_id']);
                    }
                }

                // client
                if ($key == 'client_id') {
                    if (isset($filter['client_id']) && $filter['client_id'] != '') {
                        $query->where('client_id', $filter['client_id']);
                    }
                }

            // branch
                if ($key == 'branch_id') {
                    if (isset($filter['branch_id']) && $filter['branch_id'] != '') {
                        $query->where('branch_id', $filter['branch_id']);
                    }
                }
                
            // transaction_owner
                if ($key == 'transaction_owner') {
                    if (isset($filter['transaction_owner']) && $filter['transaction_owner'] != '') {
                        $query->where('transaction_owner', $filter['transaction_owner']);
                    }
                }


                require app_path('Helpers/globalFilter/created_at.php');
            }
        }

        return $query;
    }
}