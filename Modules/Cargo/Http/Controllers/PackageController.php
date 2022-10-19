<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\PackagesDataTable;
use Modules\Cargo\Http\Requests\PackageRequest;
use Modules\Cargo\Entities\Package;
use Modules\Acl\Repositories\AclRepository;

class PackageController extends Controller
{
    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('can:manage-packages');
        $this->middleware('can:view-packages')->only('index');
        $this->middleware('can:view-packages')->only('show');
        $this->middleware('can:create-packages')->only('create', 'store');
        $this->middleware('can:edit-packages')->only('edit', 'update');
        $this->middleware('can:delete-packages')->only('delete', 'multiDestroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PackagesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.packages'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(PackagesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.packages.index', $share_data);
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
                'name' => __('cargo::view.packages'),
                'path' => fr_route('packages.index')
            ],
            [
                'name' => __('cargo::view.packages'),
            ]
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PackageRequest $request)
    {
        
        $data = $request->only(['name','cost']);
        $data['name'] = json_encode($request->name);
        $package = Package::create($data);
        return redirect()->route('packages.index')->with(['message_alert' => __('cargo::messages.created')]);
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
                'name' => __('cargo::view.packages'),
                'path' => fr_route('packages.index')
            ],
            [
                'name' => __('cargo::view.edit_package')
            ],
        ]);
        $package = Package::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.packages.edit')->with(['model' => $package]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PackageRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $package = Package::findOrFail($id);
        $data = $request->only(['name','cost']);
        $data['name'] = json_encode($request->name);
        $package->update($data);
        return redirect()->route('packages.index')->with(['message_alert' => __('cargo::messages.saved')]);
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

        Package::destroy($id);
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
        Package::destroy($ids);
        return response()->json(['message' => __('cargo::messages.multi_deleted')]);
    }

    public function post_config_package_costs(Request $request)
    {
        $counter = 0;
        foreach ($request->package_id as $package) {
            $pack = Package::find($request->package_id[$counter]);
            $pack->cost = $request->package_extra[$counter];
            $pack->save();
            $counter++;
        }
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);
    }
}
