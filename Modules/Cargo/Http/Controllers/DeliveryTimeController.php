<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\DeliveryTimesDataTable;
use Modules\Cargo\Http\Requests\DeliveryTimeRequest;
use Modules\Cargo\Entities\DeliveryTime;
use Modules\Acl\Repositories\AclRepository;

class DeliveryTimeController extends Controller
{
    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('can:manage-delivery-time');
        $this->middleware('can:view-delivery-time')->only('index');
        $this->middleware('can:view-delivery-time')->only('show');
        $this->middleware('can:create-delivery-time')->only('create', 'store');
        $this->middleware('can:edit-delivery-time')->only('edit', 'update');
        $this->middleware('can:delete-delivery-time')->only('delete', 'multiDestroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(DeliveryTimesDataTable $dataTable)
    {

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.delivery_time')
            ]
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(DeliveryTimesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.deliveryTimes.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.delivery_time'),
                'path' => fr_route('delivery_time.index')
            ],
            [
                'name' => __('cargo::view.add_delivery_time'),
            ],
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.deliveryTimes.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DeliveryTimeRequest $request)
    {
        $data = $request->only(['name', 'hours']);
        $data['name'] = json_encode($request->name);
        $DeliveryTime = DeliveryTime::create($data);
        return redirect()->route('deliveryTime.index')->with(['message_alert' => __('cargo::messages.created')]);
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
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.delivery_time'),
                'path' => fr_route('deliveryTime.index')
            ],
            [
                'name' => __('cargo::view.edit_delivery_time'),
            ],
        ]);
        $deliveryTime = DeliveryTime::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.deliveryTimes.edit')->with(['model' => $deliveryTime]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DeliveryTimeRequest $request, $id)
    {
        $deliveryTime = DeliveryTime::findOrFail($id);
        $data = $request->only(['name', 'hours']);
        $data['name'] = json_encode($request->name);
        $deliveryTime->update($data);
        return redirect()->route('deliveryTime.index')->with(['message_alert' => __('cargo::messages.saved')]);
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

        DeliveryTime::destroy($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);
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
        DeliveryTime::destroy($ids);
        return response()->json(['message' => __('cargo::messages.multi_deleted')]);
    }
}