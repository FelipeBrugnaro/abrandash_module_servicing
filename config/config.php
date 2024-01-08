<?php

return [
    'name' => 'servicing',


    'routes' => [
        'index'   => 'admin.site_servicing.index',
        'edit'    => 'admin.site_servicing.edit',
        'create'  => 'admin.site_servicing.create',

        'store'  => 'admin.site_servicing.store',
        'update' => 'admin.site_servicing.update',
        'delete' => 'admin.site_servicing.destroy',
    ]
];