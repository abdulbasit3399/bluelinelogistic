<?php

namespace Modules\Pages\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Pages\Entities\Page;
use Modules\Pages\Transformers\Front\PageResource;

class PageController extends Controller
{


    /**
     * Show sinlge page
     * 
     * @return View
     */
    public function show(Request $request, $slug)
    {
        if (auth()->check() && auth()->user()->can('view-pages')) {
            $page = Page::where('slug', $slug)->with('creator')->first();
        }else{
            $page = Page::where('slug', $slug)->with('creator')->showInFront()->first();
        }

        if(!$page){
            return view('theme.pages.error')->with([
                'message' => __('pages::messages.pages.dont_have_the_permissions'),
            ]);
        }
        $page_resource = collect(new PageResource($page))->toArray();
        return view('theme.pages.page')->with([
            'page' => $page_resource,
        ]);
    }

}
