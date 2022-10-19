<?php

namespace Modules\Currency\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Currency\Http\DataTables\CurrenciesDataTable;
use Modules\Currency\Entities\Currency;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Currency\Http\Requests\CurrencyRequest;
use DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CurrenciesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('currency::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('currency::view.currencies'),
            ],
        ]);
        $active_currencies = Currency::where('status', 1)->get();
        $data_with = ['active_currencies' => $active_currencies ];
        $share_data = array_merge(get_class_vars(CurrenciesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('currency::'.$adminTheme.'.pages.currencies.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('currency::'.$adminTheme.'.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CurrencyRequest $request)
    {
        $data = $request->only(['name','symbol','code','exchange_rate']);
        DB::beginTransaction();
        $model = new Currency();
        $model->fill($data);
        $model->status = 0;        
        if (!$model->save()){
            throw new \Exception();
        }
        DB::commit();
        return redirect()->route('currencies.index')->with(['message_alert' => __('currency::messages.created')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('currency::'.$adminTheme.'.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        breadcrumb([
            [
                'name' => __('currency::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('currency::view.currencies'),
                'path' => fr_route('currencies.index')
            ],
            [
                'name' => __('currency::view.edit_currency')
            ]
        ]);
        $item = Currency::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('currency::'.$adminTheme.'.pages.currencies.edit')->with([
            'model' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CurrencyRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        $data = $request->only(['name','symbol','code','exchange_rate']);
        DB::beginTransaction();
        $model = Currency::find($id);
        $model->fill($data);
        if (!$model->save()){
            throw new \Exception();
        }
        DB::commit();
        return redirect()->route('currencies.index')->with(['message_alert' => __('currency::messages.saved')]);
    }

    public function update_default_currency(Request $request)
    {
        $default_currency = Currency::findOrFail($request->system_default_currency);
        $default_currency->default = 1;
        $default_currency->save();

        return redirect()->route('currencies.index')->with(['message_alert' => __('currency::messages.saved')]);
    }

    public function update_status(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        $currency = Currency::findOrFail($request->id);
        if($request->status == 0){
            if (Currency::where('default',1)->first()->id == $currency->id) {
                return 0;
            }
        }
        $currency->status = $request->status;
        $currency->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        Currency::destroy($id);
        return response()->json(['message' => __('currency::messages.deleted')]);
    }


    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Renderable
     */
    public function multiDestroy(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = $request->ids;
        Currency::destroy($ids);
        return response()->json(['message' => __('currency::messages.multi_deleted')]);
    }

    public function getSystemCurrency(Request $request)
    {
        $currency = Currency::where('default',1)->first();
        return response()->json($currency);
    }
}
