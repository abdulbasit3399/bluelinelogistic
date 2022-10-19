<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\MissionAction;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Mission;

class SendMissionActionNotification
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
    public function handle(MissionAction $event)
    {
        $gateways = get_notification_gateways();

        $missions = Mission::find($event->mission_ids ?? []);

        foreach ($missions as $mission)
        { 
            $action = Mission::getStatusByStatusId($mission->status_id);

            $users = get_notification_users('mission_action',$mission);
            $users = \App\Models\User::whereIn('id',$users)->get();
            $title   = 'There is '.$action.' mission';
            $content = __('cargo::messages.check_item');
            $url     = route('missions.show', $mission->id);

            foreach($users as $user){
                send_notification($user,$gateways,'mission_action', $title, $content, $url, $mission);
            }

            foreach ($mission->shipment_mission as $shipment_mission)
            {
                $shipment = $shipment_mission->shipment;

                $shipment_title   = __('cargo::view.There_is_update_shipment');
                $shipment_content = __('cargo::messages.check_item');
                $shipment_url     = route('shipments.show', $shipment->id);

                $shipment_users = get_notification_users('shipment_action',$shipment);
                $shipment_users = \App\Models\User::whereIn('id',$shipment_users)->get();
                foreach($shipment_users as $user){
                    send_notification($user,$gateways,'shipment_action', $shipment_title, $shipment_content, $shipment_url, $shipment);
                }

            }
        }
    }
}
