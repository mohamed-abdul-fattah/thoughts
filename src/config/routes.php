<?php

return [
    '/'               => 'home@index',
    '/locale/switch'  => 'home@switchLocale',
    '/shelves'        => 'shelves@show',
    '/shelves/create' => 'shelves@create',
    '/shelves/store'  => 'shelves@store',
    '/shelves/edit'   => 'shelves@edit',
    '/shelves/update' => 'shelves@update',
    '/notebooks'      => 'notebooks@show',
    '/notes/create'   => 'notes@create',
    '/notes/store'    => 'notes@store',
    '/notes'          => 'notes@show',
    '/notes/edit'     => 'notes@edit',
    '/notes/update'   => 'notes@update',
    '/notes/delete'   => 'notes@delete',
];
