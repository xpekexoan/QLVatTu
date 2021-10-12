<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang chủ', route('index'));
});

Breadcrumbs::for('nguoidung', function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý người dùng');
});

Breadcrumbs::for('phieumua', function ($trail) {
    $trail->parent('home');
    $trail->push('Phiếu đề nghị mua');
});

Breadcrumbs::for('phieubangiao', function ($trail) {
    $trail->parent('home');
    $trail->push('Phiếu bàn giao');
});

Breadcrumbs::for('vattu', function ($trail) {
    $trail->parent('home');
    $trail->push('Quản lý vật tư');
});

Breadcrumbs::for('xetduyet', function ($trail) {
    $trail->parent('home');
    $trail->push('Xét duyệt phiếu đề nghị');
});

Breadcrumbs::for('thongke', function ($trail) {
    $trail->parent('home');
    $trail->push('Thống kê');
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Trang cá nhân');
});