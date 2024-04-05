<?php

return [
    '/'               => 'home@index',
    '/shelves'        => 'shelves@show',
    '/shelves/create' => 'shelves@create',
    '/shelves/store'  => 'shelves@store',
    '/notebooks'      => 'notebooks@show',
    '/notes/create'   => 'notes@create',
    '/notes/store'    => 'notes@store',
    '/notes'          => 'notes@show',
    '/notes/edit'     => 'notes@edit',
    '/notes/delete'    => 'notes@delete',
];
