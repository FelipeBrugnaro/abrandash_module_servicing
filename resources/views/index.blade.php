@extends('admin.layouts.dashboard')
@section('title', textLang('title', 'servicing::lang'))

@section('page')

@component('admin.components.pages.header', [
    'title' => textLang('title', 'servicing::lang'),
    'description' => textLang('description', 'servicing::lang'),
])
@if(Auth::user()->permission('CREATE_SERVICING'))
@slot('btncreate', config('servicing.routes.create'))
@endif
@endcomponent

<div class="card">
    <x-admin.elements.table
        :paginate="$servicings->links('admin.components.paginate')">
        <x-slot:thead>
            <th>{{ textLang('icon', 'servicing::lang.thead') }}</th>
            <th>{{ textLang('title', 'servicing::lang.thead') }}</th>
            <th>{{ textLang('status', 'servicing::lang.thead') }}</th>
        </x-slot:thead>
        <x-slot:tbody>
                @foreach ($servicings as $key => $servicing)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>
                        <img
                            class="rounded w-10 h-10" 
                            src="{{ $servicing->icon }}" 
                            alt="{{ $servicing->title }}">
                    </td>
                    <td>{{ $servicing->title }}</td>
                    <th>
                        <x-admin.elements.status :status="$servicing->status" />
                    </th>
                    <x-admin.elements.table.action>
                        @slot('buttons')
                            @if(Auth::user()->permission('EDIT_SERVICING'))
                            <li>
                                <x-admin.elements.link 
                                    :title="textLang('Edit')" 
                                    :href="route(config('servicing.routes.edit'), ['servicing' => $servicing->id])"  
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="pencil" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements-link>
                            </li>
                            @endif
                            @if(Auth::user()->permission('DELETE_SERVICING'))
                            <li>
                            <form 
                                class="block full"
                                action="{{ route(config('servicing.routes.delete'), ['servicing' => $servicing->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <x-admin.elements.button 
                                    type="submit" 
                                    :title="textLang('Delete')" 
                                    data-te-dropdown-item-ref>
                                    @slot('icon')
                                    <x-admin.elements.icon 
                                        icon="trash" 
                                        class="inline w-3 h-3 -mt-[3px] mr-1" />
                                    @endslot
                                </x-admin.elements.button>
                            </form>
                            </li>
                            @endif
                        @endslot
                    </x-admin.elements.table.action>
                <tr>
                @endforeach
        </x-slot:tbody>
    </x-admin.page.table.table>
</div>
@endsection