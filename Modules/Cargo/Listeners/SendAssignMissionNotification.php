<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\AssignMission;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Mission;

class SendAssignMissionNotification
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
    public function handle(AssignMission $event)
    {
        $gateways = get_notification_gateways();
        
        $missions = Mission::find($event->mission_ids ?? []);

        $title      = __('cargo::view.There_is_assign_mission');
        $content    = __('cargo::messages.check_item');
        foreach ($missions as $mission)
        { 
            $url   = route('missions.show', $mission->id);
            $users = get_notification_users('mission_action',$mission);
            $users = \App\Models\User::whereIn('id',$users)->get();
            foreach($users as $user){
                send_notification($user,$gateways,'assigned_mission', $title, $content, $url, $mission);
            }

            foreach ($mission->shipment_mission as $shipment_mission)
            {
                $shipment = $shipment_mission->shipment;

                $shipment_title   = __('cargo::view.There_is_update_shipment');
                $shipment_content = __('cargo::messages.check_item');
                $shipment_url     = route('shipments.show', $shipment->id);

                $shipment_users = get_notification_users('assigned_shipments',$shipment);
                $shipment_users = \App\Models\User::whereIn('id',$shipment_users)->get();
                foreach($shipment_users as $user){
                    send_notification($user,$gateways,'assigned_shipment', $shipment_title, $shipment_content, $shipment_url, $shipment);
                }

            }
        }
        
    }
}
