<?php

namespace Modules\Cargo\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Cargo\Events\AddClient;
use Modules\Cargo\Entities\Event;
use Modules\Cargo\Entities\Client;

class SendClientNotification
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
    public function handle(AddClient $event)
    {
        $users    = get_notification_users('new_customer');
        $gateways = get_notification_gateways();

        $client = $event->client;
        $client = Client::find($client->id ?? []);

        $title      = __('cargo::view.There_is_a_new_customer_created');
        $content    = __('cargo::messages.check_item');
        $url        = route('clients.show', $client->id);

        $users   = \App\Models\User::whereIn('id',$users)->get();
        
        foreach($users as $user){
            send_notification($user,$gateways,'new_customer', $title, $content, $url, $client);
        }
    }
}
