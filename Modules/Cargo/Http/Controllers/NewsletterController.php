<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mail;
use Modules\Cargo\Mail\EmailManager;

class NewsletterController extends Controller
{
    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        if (!filter_var(env('MAIL_USERNAME'), FILTER_VALIDATE_EMAIL)) {
            $array['from'] = env('MAIL_FROM_ADDRESS');
        }else{
            $array['from'] = env('MAIL_USERNAME');
        }
        $array['content'] = "This is a test email.";
        
        try {

            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        return back()->with(['message_alert' => __('cargo::view.an_email_has_been_sent')]);
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
