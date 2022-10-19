<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\GoogleSettings;
use App\Http\Requests\NotificationsRequest;
use App\Events\NotificationSettingsUpdated;

class GoogleSettingsController extends Controller
{
    public function googleMapSettings(Request $request)
    {
        $googleSettings = resolve(\app\Models\GoogleSettings::class)->toArray();
        $googleMap      = json_decode($googleSettings['google_map'], true);
        return response()->json($googleMap);  
    }
}
