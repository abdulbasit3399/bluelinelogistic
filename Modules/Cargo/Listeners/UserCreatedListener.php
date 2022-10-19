<?php

namespace Modules\Cargo\Listeners;

use Modules\Users\Events\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreatedListener
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
    public function handle(UserCreatedEvent $event)
    {
        
        if(isset($event->user)){
            $user = $event->user;
            
            $model = new \Modules\Cargo\Entities\Staff();
            $data = array(
                'code' => 0,
                'user_id' => $user['user_id'],
                'responsible_mobile' => $user['responsible_mobile'],
                'national_id' => $user['national_id'],
                'branch_id' => $user['branch_id'],
                'created_by' => auth()->id(),
            );
            $model->fill($data);
            if (!$model->save()){
                throw new \Exception();
            }
            $model->code = $model->id;
            if (!$model->save()){
                throw new \Exception();
            }
        }
    }
}
