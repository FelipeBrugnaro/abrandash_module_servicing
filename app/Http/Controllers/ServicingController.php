<?php

namespace Modules\Servicing\app\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Servicing\app\Models\Servicing;
use Modules\Servicing\app\Http\Requests\{
    ServicingUpdateRequest,
    ServicingStoreRequest
};
use Illuminate\Http\{Request, RedirectResponse};

class ServicingController
{

    public function index(Request $request, Servicing $servicing)
    {

        $search = $request->search;
        $qnt = $request->qnt ?? 10;

        $servicings = $servicing->where([
            ['title', 'like','%'.$search.'%'],
        ])->orderBy('id', 'ASC')->paginate($qnt)->withQueryString();
        
        return view('servicing::index', [
            'servicings' => $servicings
        ]);
    }

    public function edit(Servicing $servicing)
    {
        if(!Auth::user()->permission('EDIT_SERVICING')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('servicing::edit', [
            'servicing' => $servicing
        ]);
    }

    public function create()
    {
        if(!Auth::user()->permission('CREATE_SERVICING')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('servicing::create');
    }

    // STORE

    public function store(
        ServicingStoreRequest $request, 
        Servicing $servicing
    ) : RedirectResponse 
    {

        $icon = $request->file('icon');
        if($icon) {
            $upload = imageUploader($icon);
            $servicing->icon = $upload;
        }

        $servicing->title = $request->title;
        $servicing->description = $request->description;
        $servicing->status = false;

        if(!$servicing->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('create_danger', 'servicing::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('servicing.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('create_success', 'servicing::lang.messages')
        ]);
    }

    // UPDATE

    public function update(
        ServicingUpdateRequest $request, 
        Servicing $servicing
    ) : RedirectResponse 
    {

        $icon = $request->file('icon');
        if($icon) {
            $upload = imageUploader($icon);
            $servicing->icon = $upload ? $upload : $servicing->icon;
        }
        

        $servicing->title = $request->title ?? $servicing->title;
        $servicing->description = $request->description ?? $servicing->description;
        $servicing->status = $request->status ?? $servicing->status;

        if(!$servicing->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('update_danger', 'servicing::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('servicing.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('update_success', 'servicing::lang.messages')
        ]);
    }

    // DELETE
    
    public function destroy(Servicing $servicing): RedirectResponse 
    {
        
        if(!$servicing->delete()) {
            return redirect()
                ->back()
                ->with(['toast' => [
                    'level'   => 'danger',
                    'message' => textLang('delete_danger', 'servicing::lang.messages')
            ]]);
        }

        return redirect()
            ->back()
            ->with(['toast' => [
                'level'   => 'success',
                'message' => textLang('delete_success', 'servicing::lang.messages')
        ]]);
    }
}
