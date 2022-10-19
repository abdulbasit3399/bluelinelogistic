<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\CreateMission;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Mission;

class SendCreateMissionNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateMission $event)
    {
        $users    = get_notification_users('new_mission');
        $gateways = get_notification_gateways();

        $mission = $event->mission;
        $mission = Mission::find($mission->id ?? []);

        $title      = __('cargo::view.There_is_a_new_mission_created');
        $content    = __('cargo::messages.check_item');
        $url        = url('admin/missions').'/'.$mission->id;

        $users = \App\Models\User::whereIn('id',$users)->get();
        foreach($users as $user){
            send_notification($user,$gateways,'new_mission', $title, $content, $url, $mission);
        }

        foreach ($mission->shipment_mission as $shipment_mission)
        {
            $shipment = $shipment_mission->shipment;

            $shipment_title   = __('cargo::view.There_is_update_shipment');
            $shipment_content = __('cargo::messages.check_item');
            $shipment_url     = route('shipments.show', $shipment->id);

            $shipment_users = get_notification_users('update_shipments',$shipment);
            $shipment_users = \App\Models\User::whereIn('id',$shipment_users)->get();
            foreach($shipment_users as $user){
                send_notification($user,$gateways,'update_shipment', $shipment_title, $shipment_content, $shipment_url, $shipment);
            }

        }
    }
}
