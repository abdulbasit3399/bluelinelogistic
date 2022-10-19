<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentStatus;

class ShipmentStatusController extends Controller
{
    public function shipment_status($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        $data['shipment'] = Shipment::find($id);
        $data['shipment_status'] = ShipmentStatus::where('shipment_id',$id)->get();
        return view('cargo::'.$adminTheme.'.pages.shipments.shipment_status',compact('data'));
    }
    public function shipment_status_store(Request $request)
    {
        $request->validate([
            'shipment_id' => 'required'
        ]);
        ShipmentStatus::where('shipment_id',$request->shipment_id)->delete();
        for($i=0; $i < count($request->Package); $i++)
        {
            $shipment_status = new ShipmentStatus;
            $shipment_status->shipment_id = $request->shipment_id;
            $shipment_status->current_address = $request->Package[$i]['location'];
            $shipment_status->receipt_no = $request->Package[$i]['receipt_no'];
            $shipment_status->current_status = $request->Package[$i]['ship_status'];
            $shipment_status->date = $request->Package[$i]['date'];
            $shipment_status->local_time = $request->Package[$i]['local_time'];
            $shipment_status->ship_icon = $request->Package[$i]['ship_icon'];

            $shipment_status->save();
        }

        return redirect()->back();

    }
}
