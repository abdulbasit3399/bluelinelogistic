<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\UpdateMission;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Mission;

class SendUpdateMissionNotification
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
    public function handle(UpdateMission $event)
    {
        $users    = get_notification_users('mission_action');
        $gateways = get_notification_gateways();

        $missions = Mission::find($event->mission_ids ?? []);

        $users   = \App\Models\User::whereIn('id',$users)->get();
        foreach ($missions as $mission)
        { 
            $title   =  __('cargo::view.There_is_an_updated_mission');
            $content = __('cargo::messages.check_item');
            $url     = route('missions.show', $mission->id);

            foreach($users as $user){
                send_notification($user,$gateways,'update_mission', $title, $content, $url, $mission);
            }
        }
    }
}
