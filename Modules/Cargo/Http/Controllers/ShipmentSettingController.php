<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\ShipmentSetting;
use Modules\Acl\Repositories\AclRepository;

class ShipmentSettingController extends Controller
{
    private $aclRepo;
    
    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.index');
    }

    public function settings()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipping_settings'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view($adminTheme.'.pages.settings', ['fields' => ShipmentSetting::fields()]);
    }
    public function storeSettings(ShipmentSetting $settings,Request $request)
    {
        
        foreach(ShipmentSetting::fields() as $field_key => $field){
            if (ShipmentSetting::where('key',$field_key)->count() == 0) {
                $settings = new ShipmentSetting();
                $settings->key   = $field_key;
                $settings->value = isset($request->fields[$field_key]) ? $request->fields[$field_key] : '';
            }else{
                $settings = ShipmentSetting::where('key', $field_key)->first();
                $settings->value = isset($request->fields[$field_key]) ? $request->fields[$field_key] : '';
            }
            $settings->save();
        }
        
        
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);
    }

    public function feesSettings()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipping_rates'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipment-settings.fees-settings');
    }

    public function storeFeesSettings(Request $request)
    {
        foreach ($request->Setting as $key => $value) {
            if (ShipmentSetting::where('key',$key)->count() == 0) {
                $set = new ShipmentSetting();
                $set->key = $key;
                $set->value = $value;
                $set->save();
            } else {
                $set = ShipmentSetting::where('key', $key)->first();
                $set->value = $value;
                $set->save();
            }
        }

        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
