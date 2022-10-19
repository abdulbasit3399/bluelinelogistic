<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\AreasDataTable;
use Modules\Cargo\Http\Requests\PackageRequest;
use Modules\Cargo\Entities\Package;
use Modules\Cargo\Entities\Country;
use Modules\Cargo\Entities\State;
use Modules\Cargo\Entities\Area;
use Modules\Cargo\Http\Requests\AreaRequest;
use Modules\Acl\Repositories\AclRepository;

class AreaController extends Controller
{

    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('can:manage-areas');
        $this->middleware('can:view-areas')->only('index');
        $this->middleware('can:view-areas')->only('show');
        $this->middleware('can:create-areas')->only('create', 'store');
        $this->middleware('can:edit-areas')->only('edit', 'update');
        $this->middleware('can:delete-areas')->only('delete', 'multiDestroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AreasDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.areas_management'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(AreasDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.areas.index', $share_data);
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
                'name' => __('cargo::view.areas_management'),
                'path' => fr_route('areas.index')
            ],
            [
                'name' => __('cargo::view.add_area'),
            ],
        ]);
        $countries = Country::where('covered',1)->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.areas.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AreaRequest $request)
    {
        $data = $request->only(['state_id','name']);
        $data['name'] = json_encode($request->name);
        $area = Area::create($data);
        return redirect()->route('areas.index')->with(['message_alert' => __('cargo::messages.created')]);
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
                'name' => __('cargo::view.areas_management'),
                'path' => fr_route('areas.index')
            ],
            [
                'name' => __('cargo::view.edit_area'),
            ],
        ]);
        $countries = Country::where('covered',1)->get();
        $area   = Area::findOrFail($id);
        $states = State::where('country_id',$area->state->country_id)->where('covered',1)->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.areas.edit')->with(['model' => $area, 'countries' => $countries , 'states' => $states]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(AreaRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $area = Area::findOrFail($id);
        $data = $request->only(['name', 'state_id']);
        $data['name'] = json_encode($request->name);
        $area->update($data);
        return redirect()->route('areas.index')->with(['message_alert' => __('cargo::messages.saved')]);
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

        Area::destroy($id);
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
        Area::destroy($ids);
        return response()->json(['message' => __('cargo::messages.multi_deleted')]);
    }
}
