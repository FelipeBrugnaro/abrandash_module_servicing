@extends('admin.layouts.dashboard')
@section('title', textLang('title_edit', 'servicing::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title_edit', 'servicing::lang'),
    'description' => textLang('description_edit', 'servicing::lang'),
    'btnback' => config('servicing.routes.index'),
])
@endcomponent

<div class="card">
    <form 
        action="{{ route(config('servicing.routes.update'), ['servicing' => $servicing->id]) }}" 
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('servicing::partials.form')

        <x-admin.elements.select 
            name="status" 
            :label="textLang('status', 'servicing::lang.form')">
            <option 
                value="1" 
                @if ($servicing->status == true) selected @endif>
            <span>{{ textLang('Actived') }}</span>
            </option>
            <option 
                value="0" 
                @if ($servicing->status == false) selected @endif>
            <span>{{ textLang('Disabled') }}</span>
            </option>
        </x-admin.elements.select>
        
        <div class="flex items-center justify-end gap-3">
            <x-admin.elements.button
                class="mt-4 btn btn-sm btn-primary" 
                type="submit" 
                :title="textLang('Edit')" />
        </div>
    </form>
</div>
@endsection