<?php

namespace App\Notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

use \App\Http\Controllers\Api\SendNotification;
use App\Channels\SmsChannel;
use App\Channels\PushChannel;

class GlobalNotification extends Notification
{
    public $data;
    public $gateway;

    public function __construct($data = [], $gateway = [])
    {
        $this->data = $data;
        $this->gateway = $gateway;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        
        if (!$this->gateway){
            return ['mail', 'database'];
        }else{
            $arr = [];
            foreach ($this->gateway as $gateway){
                if ($gateway == 'mail' || $gateway == 'email'){
                    $arr[] = 'mail';
                } elseif ($gateway == 'system' || $gateway == 'database'){
                    $arr[] = 'database';
                } elseif ($gateway == 'fcm'){
                    $arr[] = PushChannel::class;
                } elseif ($gateway == 'sms'){
                    $arr[] = SmsChannel::class;
                } else {
                    // before type any gateway, check the "to" method if exist or NOT firstly
                    $arr[] = $gateway;
                }
            }
            return $arr;
        }
    }

    public function toMail($notifiable)
    {
        $params = $this->data;
        $url = $params['message']['url'];
        return (new MailMessage)
            ->subject($params['message']['subject'])
            ->action('View', $url)
            ->line($params['message']['content']);
    }

    public function toSms($notifiable)
    {
        $params = $this->data;
        return sendSMS($notifiable->phone, $params['message']['subject']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return $this->data;
    }

    public function toPush($notifiable)
    {
        $params = $this->data;
        $notification = new SendNotification();
      	
        $push = $notification
            ->withKey(env('FCM_SERVER_KEY'))
            ->withTitleAndBody($params['message']['subject'],$params['message']['content'])
            ->withData($params['message'])
            ->to($params['to'])
            ->send();
      	
        return $this;
    }
}
