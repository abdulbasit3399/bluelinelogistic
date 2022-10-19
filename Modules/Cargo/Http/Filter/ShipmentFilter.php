<?php

namespace Modules\Cargo\Http\Filter;


/**
 * Use this class to add filter on users in query database.
 */
class ShipmentFilter
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


                    // branch_id
                    if ($key == 'branch_id')
                    {
                        if (isset($filter['branch_id']) && $filter['branch_id'] != '') {
                            $query->where('branch_id', $filter['branch_id']);
                        };
                    }

                    // client_id
                    if ($key == 'client_id') {
                        if (isset($filter['client_id']) && $filter['client_id'] != '')
                        {
                            $query->where('client_id', $filter['client_id']);
                        };
                    }


                    // payment_type
                    if ($key == 'payment_type') {
                        if (isset($filter['payment_type']) && $filter['payment_type'] != '')
                        {
                            $query->where('payment_type', $filter['payment_type']);
                        };
                    }

                    // captain_id
                    if ($key == 'captain_id') {
                        if (isset($filter['captain_id']) && $filter['captain_id'] != '')
                        {
                            $query->where('captain_id', $filter['captain_id']);
                        };
                    }

                                        
                    // payment_method_id
                    if ($key == 'payment_method_id') {
                        if (isset($filter['payment_method_id']) && $filter['payment_method_id'] != '')
                        {
                            $query->where('payment_method_id', $filter['payment_method_id']);
                        };
                    }

                    // paid
                    if ($key == 'paid') {
                        if (isset($filter['paid']) && $filter['paid'] != '')
                        {
                            $query->where('paid', $filter['paid']);
                        };
                    }

                    // shipping_date
                    if ($key == 'shipping_date') {
                        if (isset($filter['shipping_date']) && $filter['shipping_date'] != '')
                        {
                            $query->where('shipping_date', $filter['shipping_date']);
                        };
                    }

                    // status_id
                    if ($key == 'status_id') {
                        if (isset($filter['status_id']) && $filter['status_id'] != '')
                        {
                            $query->where('status_id', $filter['status_id']);
                        };
                    }


                require app_path('Helpers/globalFilter/created_at.php');
            }
        }


        return $query;
    }
}