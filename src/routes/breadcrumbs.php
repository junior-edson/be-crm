<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});

// Home > Dashboard > Client Management
Breadcrumbs::for('client-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Client Management', route('client-management.clients.index'));
});

// Home > Dashboard > Client Management > Clients
Breadcrumbs::for('client-management.clients.index', function (BreadcrumbTrail $trail) {
    $trail->parent('client-management.index');
    $trail->push('Clients', route('client-management.clients.index'));
});

// Home > Quotations
Breadcrumbs::for('quotation.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Quotations', route('quotation.quotation.index'));
});

// Home > Quotations > Create quotation
Breadcrumbs::for('quotation.create', function (BreadcrumbTrail $trail) {
    $trail->parent('quotation.index');
    $trail->push('Create quotation', route('quotation.quotation.create'));
});

// Home > Quotations > View quotation
Breadcrumbs::for('quotation.show', function (BreadcrumbTrail $trail, $quotationId) {
    $trail->parent('quotation.index');
    $trail->push('View quotation', route('quotation.quotation.show', $quotationId));
});

// Home > Quotations > Edit quotation
Breadcrumbs::for('quotation.edit', function (BreadcrumbTrail $trail, $quotationId) {
    $trail->parent('quotation.index');
    $trail->push('Edit quotation', route('quotation.quotation.edit', $quotationId));
});
