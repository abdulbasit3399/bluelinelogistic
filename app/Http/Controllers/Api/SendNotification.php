<?php
namespace App\Http\Controllers\Api;

class SendNotification {
    /**
     * notification title
     *
     * @var string
     */
    protected $title;
    /*
     * FCM Device Token
     * */
    protected $to;

    /**
     * notification body
     *
     * @var string
     */
    protected $body;

    /**
     * set notification data
     *
     * @var array
     */
    protected $data;

    /**
     * notification mode
     *
     * @var string
     */
    protected $mode = 'production';

    /**
     * server key to be used while sending the notifications
     *
     * @var string
     */
    private $serverKey;

    /**
     * set notification title and body
     *
     * @param string $title
     * @param string $body
     * @return $this
     */
    public function withTitleAndBody($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
        return $this;
    }

    /**
     * set notification data
     *
     * @param array $data
     * @return $this
     */
    public function withData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * enable development mode
     *
     * @param boolean $enableDevelopmentMode
     * @return $this
     */
    public function withMode($enableDevelopmentMode = false)
    {
        if ($enableDevelopmentMode) {
            $this->mode = 'development';
            return $this;
        }
        $this->mode = 'production';
        return $this;
    }

    /**
     * set fcm authorization key
     *
     * @param string $fcmKey
     * @return $this
     */
    public function withKey($fcmKey)
    {
        $this->serverKey = $fcmKey;
        return $this;
    }

    /**
     * set notification topic
     *
     * @since      0.2.0
     * @param string $site_url
     * @return $this
     */
    public function to($token = null)
    {
        if ($this->mode == 'development') {
            return "/topics/all";
        }

        $this->to = $token;
        return $this;
    }

    /**
     * send http request to fcm
     *
     * @since 0.1.0
     * @return boolean
     */
    public function send()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = json_encode($this->getRequestBody());
        $headers = array (
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        curl_close ( $ch );

        return json_decode( $result );
    }

    /**
     * get fcm request body
     *
     * @since 0.1.0
     * @return array
     */
    private function getRequestBody()
    {
        $message = [
            'to' => $this->to,
            "android" => [
                "priority" => "high",
                "notification" => [
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK'
                ]
            ],
            "apns" => [
                "headers" => [
                    "apns-priority" => "10"
                ]
            ],
        ];

        if (!empty($this->title)) {
            $message['notification'] = [
                'title' => $this->title,
                'body' => $this->body
            ];
        }

        if (!empty($this->data)) {
            $message['data'] = $this->data;
        }

        return $message;
    }
}
