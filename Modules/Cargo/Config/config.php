<?php
if(env('INSTALLATION', false) == true){
    if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
        $settings        = app(\Modules\Cargo\Entities\CargoNotificationsSettings::class);
    }else{
        $settings        = new stdClass();
        $settings->new_registeration = $settings->new_shipments = $settings->update_shipments = $settings->new_driver = $settings->new_customer = $settings->new_staff = $settings->new_mission = $settings->mission_action = $settings->shipment_action = $settings->aprroved_shipments = $settings->rejected_shipments = $settings->assigned_shipments = $settings->driver_received = $settings->delivered_shipments = $settings->supplied_shipments = $settings->request_returned_shipments = $settings->returned_to_stock_shipments = $settings->returned_to_sender_shipments = null;
    }
}else{
    $settings        = new stdClass();
    $settings->new_registeration = $settings->new_shipments = $settings->update_shipments = $settings->new_driver = $settings->new_customer = $settings->new_staff = $settings->new_mission = $settings->mission_action = $settings->shipment_action = $settings->aprroved_shipments = $settings->rejected_shipments = $settings->assigned_shipments = $settings->driver_received = $settings->delivered_shipments = $settings->supplied_shipments = $settings->request_returned_shipments = $settings->returned_to_stock_shipments = $settings->returned_to_sender_shipments = null;
}

return [
    'name' => 'Cargo',

    // user roles
    'user_roles' => [
        '2' => 'Staff',
        '3' => 'Branch',
        '4' => 'Client',
        '5' => 'Driver',
    ],
    
    'permissions' => [
        'shipments' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-shipments',
            'view-shipments',
            'create-shipments',
            'edit-shipments',
            'delete-shipments',
            'export-table-shipments',
            'shipping-settings',
            'shipping-rates',
            'shipments-barcode-scanner',
            'shipments-log',
            'approve-shipment-action',
            'close-shipment-action',
            'refuse-shipment-action',
            'return-shipment-action',
            'assign-to-driver-action',
            'transfer-to-branch-action',
            'to-returned-stock-action',
            'saved-shipments',
            'requested-shipments',
            'approved-shipments',
            'closed-shipments',
            'assigned-shipments',
            'received-shipments',
            'deliverd-shipments',
            'supplied-shipments',
            'returned-shipments',
            'returned-stock-shipments',
            'returned-deliverd-shipments',
            'print-barcodes',
        ],

        'missions' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-missions',
            'manage-manifests',
            'view-missions',
            'create-missions',
            'edit-missions',
            'delete-missions',
            'export-table-missions',
            'create-pickup-mission',
            'create-return-mission',
            'create-supply-mission',
            'create-transfer-mission',
            'create-delivery-mission',
            'approve-assign-mission-action',
            'refuse-mission-action',
            'confirm-done-mission-action',
            'receive-mission-action',
            'closed-mission-action',
            'requested-missions',
            'assigned-approved-missions',
            'recived-missions',
            'done-missions',
            'closed-missions',
        ],

        'transactions' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-transactions',
            'view-transactions',
            'create-transactions',
            'edit-transactions',
            'delete-transactions',
            'export-table-transactions',
        ],
        
        'packages' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-packages',
            'view-packages',
            'create-packages',
            'edit-packages',
            'delete-packages',
            'export-table-packages',
        ],

        'staffs' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-staffs',
            'view-staffs',
            'create-staffs',
            'edit-staffs',
            'delete-staffs',
            'export-table-staffs',
        ],

        'branches' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-branches',
            'view-branches',
            'create-branches',
            'edit-branches',
            'delete-branches',
            'export-table-branches',
        ],

        'customers' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-customers',
            'view-customers',
            'create-customers',
            'edit-customers',
            'delete-customers',
            'export-table-customers',
        ],

        'drivers' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-drivers',
            'view-drivers',
            'create-drivers',
            'edit-drivers',
            'delete-drivers',
            'export-table-drivers',
        ],

        'delivery times' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'manage-delivery-time',
            'view-delivery-time',
            'create-delivery-time',
            'edit-delivery-time',
            'delete-delivery-time',
            'export-table-delivery-time',
        ],

        'covered places' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'add-covered-countries',
            'add-covered-regions',

            'manage-areas',
            'view-areas',
            'create-areas',
            'edit-areas',
            'delete-areas',
            'export-table-areas',
            
        ],

        'reports' => [ // this group is required if you want add any module setting, because the permissions are created under this group with the same name (setting)
            'shipments-report',
            'missions-report',
            'transactions-report',
            'branches-report',
            'clients-report',
            'drivers-report',
        ],
    ],

    'notifications' => [

        'sep1'              =>  array(
            'type'          =>  'separator',
        ),
        'headline1'         =>  array(
            'type'          =>  'headline',
            'label'         =>  'cargo::view.shipment_notifications_settings',
        ),
        'new_registeration' =>  array(
            'label'         =>  'cargo::view.new_registeration',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->new_registeration ? $settings->new_registeration : ''),
            'array'         =>  array(
                'new_registeration_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_registeration ? json_decode($settings->new_registeration, true)['new_registeration_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_registeration_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_registeration ? json_decode($settings->new_registeration, true)['new_registeration_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_registeration_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_registeration ? json_decode($settings->new_registeration, true)['new_registeration_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_registeration_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_registeration ? json_decode($settings->new_registeration, true)['new_registeration_users'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'new_shipments' =>  array(
            'label'         =>  'cargo::view.new_shipments',
            'type'          =>  'array_enable_select',
            'value'         =>  ($settings->new_shipments ? $settings->new_shipments : ''),
            'migrate'       =>  true,
            'array'         =>  array(
                'new_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_shipments ? json_decode($settings->new_shipments, true)['new_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_shipments ? json_decode($settings->new_shipments, true)['new_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_shipments ? json_decode($settings->new_shipments, true)['new_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_shipments ? json_decode($settings->new_shipments, true)['new_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->new_shipments ? json_decode($settings->new_shipments, true)['new_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'update_shipments' =>  array(
            'label'         =>  'cargo::view.update_shipments',
            'type'          =>  'array_enable_select',
            'value'         =>  ($settings->update_shipments ? $settings->update_shipments : ''),
            'migrate'       =>  true,
            'array'         =>  array(
                'update_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->update_shipments ? json_decode($settings->update_shipments, true)['update_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'update_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->update_shipments ? json_decode($settings->update_shipments, true)['update_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'update_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->update_shipments ? json_decode($settings->update_shipments, true)['update_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'update_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->update_shipments ? json_decode($settings->update_shipments, true)['update_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'update_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->update_shipments ? json_decode($settings->update_shipments, true)['update_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'new_driver' =>  array(
            'label'         =>  'cargo::view.new_driver',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->new_driver ? $settings->new_driver : ''),
            'array'         =>  array(
                'new_driver_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_driver ? json_decode($settings->new_driver, true)['new_driver_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_driver_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_driver ? json_decode($settings->new_driver, true)['new_driver_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_driver_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_driver ? json_decode($settings->new_driver, true)['new_driver_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_driver_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_driver ? json_decode($settings->new_driver, true)['new_driver_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'new_customer' =>  array(
            'label'         =>  'cargo::view.new_customer',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->new_customer ? $settings->new_customer : ''),
            'array'         =>  array(
                'new_customer_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_customer ? json_decode($settings->new_customer, true)['new_customer_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_customer_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_customer ? json_decode($settings->new_customer, true)['new_customer_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_customer_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_customer ? json_decode($settings->new_customer, true)['new_customer_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_customer_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_customer ? json_decode($settings->new_customer, true)['new_customer_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'new_staff' =>  array(
            'label'         =>  'cargo::view.new_staff',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->new_staff ? $settings->new_staff : ''),
            'array'         =>  array(
                'new_staff_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_staff ? json_decode($settings->new_staff, true)['new_staff_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_staff_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_staff ? json_decode($settings->new_staff, true)['new_staff_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_staff_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_staff ? json_decode($settings->new_staff, true)['new_staff_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_staff_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_staff ? json_decode($settings->new_staff, true)['new_staff_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'new_mission' =>  array(
            'label'         =>  'cargo::view.new_mission',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->new_mission ? $settings->new_mission : ''),
            'array'         =>  array(
                'new_mission_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->new_mission ? json_decode($settings->new_mission, true)['new_mission_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_mission_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->new_mission ? json_decode($settings->new_mission, true)['new_mission_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_mission_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->new_mission ? json_decode($settings->new_mission, true)['new_mission_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_mission_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->new_mission ? json_decode($settings->new_mission, true)['new_mission_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'new_mission_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->new_mission ? json_decode($settings->new_mission, true)['new_mission_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'mission_action' =>  array(
            'label'         =>  'cargo::view.mission_action',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->mission_action ? $settings->mission_action : ''),
            'array'         =>  array(
                'mission_action_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'mission_action_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'mission_action_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'mission_action_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'mission_action_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'mission_action_assigned'      =>   [
                    'label'         =>  'cargo::view.driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->mission_action ? json_decode($settings->mission_action, true)['mission_action_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'shipment_action' =>  array(
            'label'         =>  'cargo::view.shipment_action',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->shipment_action ? $settings->shipment_action : ''),
            'array'         =>  array(
                'shipment_action_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->shipment_action ? json_decode($settings->shipment_action, true)['shipment_action_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'shipment_action_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->shipment_action ? json_decode($settings->shipment_action, true)['shipment_action_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'shipment_action_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->shipment_action ? json_decode($settings->shipment_action, true)['shipment_action_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'shipment_action_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->shipment_action ? json_decode($settings->shipment_action, true)['shipment_action_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'shipment_action_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->shipment_action ? json_decode($settings->shipment_action, true)['shipment_action_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'aprroved_shipments' =>  array(
            'label'         =>  'cargo::view.aprroved_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->aprroved_shipments ? $settings->aprroved_shipments : ''),
            'array'         =>  array(
                'aprroved_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->aprroved_shipments ? json_decode($settings->aprroved_shipments, true)['aprroved_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'aprroved_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->aprroved_shipments ? json_decode($settings->aprroved_shipments, true)['aprroved_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'aprroved_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->aprroved_shipments ? json_decode($settings->aprroved_shipments, true)['aprroved_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'aprroved_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->aprroved_shipments ? json_decode($settings->aprroved_shipments, true)['aprroved_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'aprroved_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->aprroved_shipments ? json_decode($settings->aprroved_shipments, true)['aprroved_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'rejected_shipments' =>  array(
            'label'         =>  'cargo::view.rejected_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->rejected_shipments ? $settings->rejected_shipments : ''),
            'array'         =>  array(
                'rejected_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->rejected_shipments ? json_decode($settings->rejected_shipments, true)['rejected_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'rejected_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->rejected_shipments ? json_decode($settings->rejected_shipments, true)['rejected_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'rejected_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->rejected_shipments ? json_decode($settings->rejected_shipments, true)['rejected_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'rejected_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->rejected_shipments ? json_decode($settings->rejected_shipments, true)['rejected_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'rejected_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->rejected_shipments ? json_decode($settings->rejected_shipments, true)['rejected_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'assigned_shipments' =>  array(
            'label'         =>  'cargo::view.assigned_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->assigned_shipments ? $settings->assigned_shipments : ''),
            'array'         =>  array(
                'assigned_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'assigned_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'assigned_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'assigned_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'assigned_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'assigned_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->assigned_shipments ? json_decode($settings->assigned_shipments, true)['assigned_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'driver_received' =>  array(
            'label'         =>  'cargo::view.driver_received',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->driver_received ? $settings->driver_received : ''),
            'array'         =>  array(
                'driver_received_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'driver_received_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'driver_received_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'driver_received_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'driver_received_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'driver_received_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->driver_received ? json_decode($settings->driver_received, true)['driver_received_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'delivered_shipments' =>  array(
            'label'         =>  'cargo::view.delivered_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->delivered_shipments ? $settings->delivered_shipments : ''),
            'array'         =>  array(
                'delivered_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'delivered_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'delivered_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'delivered_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'delivered_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'delivered_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->delivered_shipments ? json_decode($settings->delivered_shipments, true)['delivered_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
            )
        ),
        'supplied_shipments' =>  array(
            'label'         =>  'cargo::view.supplied_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->supplied_shipments ? $settings->supplied_shipments : ''),
            'array'         =>  array(
                'supplied_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'supplied_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'supplied_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'supplied_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'supplied_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'supplied_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->supplied_shipments ? json_decode($settings->supplied_shipments, true)['supplied_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
                
            )
        ),
        'request_returned_shipments' =>  array(
            'label'         =>  'cargo::view.request_returned_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->request_returned_shipments ? $settings->request_returned_shipments : ''),
            'array'         =>  array(
                'request_returned_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'request_returned_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'request_returned_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'request_returned_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'request_returned_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'request_returned_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->request_returned_shipments ? json_decode($settings->request_returned_shipments, true)['request_returned_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
                
            )
        ),
        'returned_to_stock_shipments' =>  array(
            'label'         =>  'cargo::view.returned_to_stock_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->returned_to_stock_shipments ? $settings->returned_to_stock_shipments : ''),
            'array'         =>  array(
                'returned_to_stock_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_stock_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_stock_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_stock_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_stock_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_stock_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->returned_to_stock_shipments ? json_decode($settings->returned_to_stock_shipments, true)['returned_to_stock_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
                
            )
        ),
        'returned_to_sender_shipments' =>  array(
            'label'         =>  'cargo::view.returned_to_sender_shipments',
            'type'          =>  'array_enable_select',
            'migrate'       =>  true,
            'value'         =>  ($settings->returned_to_sender_shipments ? $settings->returned_to_sender_shipments : ''),
            'array'         =>  array(
                'returned_to_sender_shipments_system_administrators'      =>   [
                    'label'         =>  'cargo::view.system_administrators',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_admins(),
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_system_administrators'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_sender_shipments_users_roles'      =>   [
                    'label'         =>  'cargo::view.users_roles',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_roles(),
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_users_roles'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_sender_shipments_users'      =>   [
                    'label'         =>  'cargo::view.users',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_staff(),
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_users'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_sender_shipments_branches'      =>   [
                    'label'         =>  'cargo::view.branches',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'select',
                    'options'       =>  get_branches(),
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_branches'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_sender_shipments_sender'      =>   [
                    'label'         =>  'cargo::view.sender',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_sender'] ?? '' : ''),
                    'required'      =>  true
                ],
                'returned_to_sender_shipments_assigned'      =>   [
                    'label'         =>  'cargo::view.assigned_driver',
                    'translatable'  =>  false,
                    'multiple'      =>  true,
                    'type'          =>  'none',
                    'value'         =>  ($settings->returned_to_sender_shipments ? json_decode($settings->returned_to_sender_shipments, true)['returned_to_sender_shipments_assigned'] ?? '' : ''),
                    'required'      =>  true
                ],
                
            )
        ),
    ]
];
