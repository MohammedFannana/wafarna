<?php
return [
    [
        'icon' => 'nav-icon fas fa-home',
        'route' => 'dashboard.dashboard',
        'title' => 'لوحة التحكم',
        'active' => 'dashboard.dashboard'
    ],

    [
        'icon' => 'fas fa-user nav-icon',
        'route' => 'dashboard.user.index',
        'title' => 'المستخدمون',
        'active' => 'dashboard.user.*'
    ],

    [
        'icon' => "fas fa-house-user nav-icon",
        'route' => 'dashboard.merchant.index',
        'title' =>  'التجار',
        'active' => 'dashboard.merchant.*'
    ],

    [
        'icon' => "fas fa-user-cog nav-icon",
        'route' => 'dashboard.admin.index',
        'title' =>  'المسؤولون',
        'active' => 'dashboard.admin.*'
    ],

    [
        'icon' => "fas fa-building nav-icon",
        'route' => 'dashboard.category.index',
        'title' =>  'الأقسام المتوفرة',
        'active' => 'dashboard.category.*'
    ],

    [
        'icon' => "fab fa-product-hunt nav-icon",
        'route' => 'dashboard.product.index',
        'title' =>  'المنتجات',
        'active' => 'dashboard.product.*'
    ],

    [
        'icon' => "fas fa-plus nav-icon",
        'route' => 'dashboard.products.index',
        'title' =>  ' طلبات الانتظار ',
        'active' => 'dashboard.products.*'
    ],

    [
        'icon' => "fas fa-plus nav-icon",
        'route' => 'dashboard.plans.index',
        'title' =>  '  خطط الاشتراكات ',
        'active' => 'dashboard.plans.*'
    ],

    [
        'icon' => "fas fa-plus nav-icon",
        'route' => 'dashboard.home.information.index',
        'title' =>  ' معلومات الصفحةالرئيسية',
        'active' => 'dashboard.home.information.*'
    ],


];
