<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payments\Entities\PaymentSetting;
use Modules\Payments\Http\Requests\PaymentSettingRequest;

class PaymentsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.payments_settings'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        
        return view('payments::'.$adminTheme.'.pages.payments-settings', ['fields' => PaymentSetting::fields(),'fields_script' => PaymentSetting::scripts()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PaymentSetting $settings, PaymentSettingRequest $request)
    {        
        foreach(PaymentSetting::fields() as $field_key => $field){
            if(!isset($request->fields[$field_key])){
                $settings->$field_key   =   false;
            }else{
                
                if ($field['type'] == 'bool') {
                    $settings->$field_key   =   isset($request->fields[$field_key]) ? true : false;
                } else if ($field['type'] == 'array_boolen') {
                    $settings->$field_key   =   json_encode($request->fields[$field_key]);
                    
                } else {
                    $settings->$field_key   =   (isset($field['translatable']) && $field['translatable'] == true ) ? json_encode($request->fields[$field_key]) : $request->fields[$field_key];
                }
            }
        }
        
        $settings->save();
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('payments::'.$adminTheme.'.create');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('payments::'.$adminTheme.'.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('payments::'.$adminTheme.'.edit');
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
