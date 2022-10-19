<?php

namespace Modules\Cargo\Entities;

use App\Models\NotificationsSettings;
use Spatie\LaravelSettings\Settings;
use App\Events\NotificationSettingsUpdated;

class CargoNotificationsSettings extends NotificationsSettings
{
    public $new_registeration;
    public $new_shipments;
    public $update_shipments;
    public $new_driver;
    public $new_customer;
    public $new_staff;
    public $new_mission;
    public $mission_action;
    public $shipment_action;
    public $aprroved_shipments;
    public $rejected_shipments;
    public $assigned_shipments;
    public $driver_received;
    public $delivered_shipments;
    public $supplied_shipments;
    public $request_returned_shipments;
    public $returned_to_stock_shipments;
    public $returned_to_sender_shipments;

    public static function boot()
    {
        parent::boot();

    }
}
