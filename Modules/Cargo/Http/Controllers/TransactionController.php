<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\Transaction;
use Modules\Cargo\Http\Helpers\TransactionHelper;
use Modules\Cargo\Http\DataTables\transactionsDataTable;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(transactionsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.transactions')
            ]
        ]);

        $data_with = [];
        $share_data = array_merge(get_class_vars(transactionsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.transactions.index', $share_data);
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
                'name' => __('cargo::view.transactions'),
                'path' => fr_route('transactions.index')
            ],
            [
                'name' => __('cargo::view.add_transaction'),
            ],
        ]);

        if(auth()->user()->role == 3 || auth()->user()->role == 0){
            if(auth()->user()->role == 0){
                $user = Staff::where('user_id',auth()->user()->id)->first();
                $branch_id = $user->branch_id;
            }else {
                $user = Branch::where('user_id',auth()->user()->id)->first();
                $branch_id = $user->id;
            }

            $clients = Client::where('is_archived', 0)->where('branch_id', $branch_id)->get();
            $captains = Driver::where('is_archived', 0)->where('branch_id',$branch_id)->get();
        }else {
            $clients = Client::where('is_archived', 0)->get();
            $captains = Driver::where('is_archived', 0)->get();

            $types[Transaction::BRANCH] = ["name"=> __('cargo::view.table.branch'),"key"=> "branch"];
        }
        $branches = Branch::where('is_archived', 0)->get();
        $types[Transaction::CAPTAIN] = ["name"=> __('cargo::view.driver'),"key"=> "captain"];
        $types[Transaction::CLIENT] = ["name"=> __('cargo::view.client'),"key"=> "client"];

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.transactions.create', compact('branches', 'clients','captains','types'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|integer|min:1|max:3',
            'branch' => 'nullable|exists:branches,id',
            'client' => 'nullable|exists:clients,id',
            'captain' => 'nullable|exists:drivers,id',
            'amount' => 'required|integer|min:1,max:999999999',
            'wallet_type' => 'required|min:1,max:7',
            'description' => 'nullable|max:5000',
        ]);
        if(!$request->branch && !$request->client && !$request->captain){
            $message = __('cargo::view.please_select_branch_client_captain');
            return redirect()->back()->with(['message_alert' => $message ]);
        }
        
        $types[Transaction::CAPTAIN] = "captain";
        $types[Transaction::CLIENT] = "client";
        $types[Transaction::BRANCH] = "branch";

        if($request->wallet_type == "add"){
            $amount_sign = Transaction::CREDIT;
        }elseif($request->wallet_type == "deduct"){
            $amount_sign = Transaction::DEBIT;
        }else{
            return redirect()->back()->with(['message_alert' => __('cargo::messages.invalid_data')]);
        }

        $transaction = new TransactionHelper();
        
        if($types[$request->type] == "captain"){
            $captain = Driver::where('id', $request->captain)->withCount(['transaction AS wallet' => function ($query) { $query->select(DB::raw("SUM(value)")); }])->first();
            if($request->wallet_type == "deduct"){
                if(($captain->wallet - (int) $request->amount) < 0 ){

                    $message = __('cargo::view.captain_not_have_this_amount');
                    return redirect()->back()->with(['message_alert' => $message ]);
                }
            }
            
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::CAPTAIN,$request->captain,$amount_sign,Transaction::MANUAL_TYPE,$request->description, $captain->branch_id,$request->attachments);
        }elseif($types[$request->type] == "client"){
            $client = Client::where('id', $request->client)->first();
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::CLIENT,$request->client,$amount_sign,Transaction::MANUAL_TYPE,$request->description, $client->branch_id,$request->attachments);
        }elseif($types[$request->type] == "branch"){
            $transaction->create_mission_transaction(null,abs($request->amount) ,Transaction::BRANCH,$request->branch,$amount_sign,Transaction::MANUAL_TYPE,$request->description, $request->branch,$request->attachments);
        }else{
            return redirect()->back()->with(['message_alert' => __('cargo::messages.invalid_data')]);
        }
        return redirect()->back()->with(['message_alert' => __('cargo::messages.created')]);
    }

    public function transactionsReport(transactionsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.transactions_report')
            ]
        ]);

        $data_with = [];
        $share_data = array_merge(get_class_vars(transactionsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.transactions.report', $share_data);
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
