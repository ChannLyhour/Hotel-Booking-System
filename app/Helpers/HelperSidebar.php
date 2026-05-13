<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class HelperSidebar
{
    /**
     * Get the menu items for the sidebar.
     * 
     * @return array
     */
    public static function getMenuItems(): array
    {
        return [
            [
                'category' => 'Main Menu',
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'route' => 'admin.dashboard',
                        'icon' => 'fa-solid fa-gauge-high',
                        'active' => 'admin.dashboard',
                        'permission' => null // Always visible if logged in
                    ],
                    [
                        'label' => 'Reservations',
                        'route' => 'admin.bookings.index',
                        'icon' => 'fa-solid fa-calendar-check',
                        'active' => 'admin.bookings.*',
                        'permission' => 'bookings:view'
                    ],
                ]
            ],
            [
                'category' => 'Inventory',
                'items' => [
                    [
                        'label' => 'Manage Rooms',
                        'route' => 'admin.rooms.index',
                        'icon' => 'fa-solid fa-door-open',
                        'active' => 'admin.rooms.*',
                        'permission' => 'rooms:view'
                    ],
                    [
                        'label' => 'Hotel Amenities',
                        'route' => 'admin.amenities.index',
                        'icon' => 'fa-solid fa-sparkles',
                        'active' => 'admin.amenities.*',
                        'permission' => 'amenities:view'
                    ],
                    [
                        'label' => 'Room Types',
                        'route' => 'admin.room-types.index',
                        'icon' => 'fa-solid fa-tags',
                        'active' => 'admin.room-types.*',
                        'permission' => 'rooms:view'
                    ],
                ]
            ],
            [
                'category' => 'User Management',
                'items' => [
                    [
                        'label' => 'All Users',
                        'route' => 'admin.users.index',
                        'icon' => 'fa-solid fa-users',
                        'active' => 'admin/users*',
                        'permission' => 'users:view'
                    ],
                    [
                        'label' => 'Guest Records',
                        'route' => 'admin.guests.index',
                        'icon' => 'fa-solid fa-hospital-user',
                        'active' => 'admin/guests*',
                        'permission' => 'guests:view'
                    ],
                    [
                        'label' => 'Staff Directory',
                        'route' => 'admin.staff.index',
                        'icon' => 'fa-solid fa-user-tie',
                        'active' => 'admin/staff*',
                        'permission' => 'staff:view'
                    ],
                    [
                        'label' => 'Employees',
                        'route' => 'admin.employees.index',
                        'icon' => 'fa-solid fa-people-group',
                        'active' => 'admin/employees*',
                        'permission' => 'staff:view'
                    ],
                    [
                        'label' => 'Roles & Permissions',
                        'route' => 'admin.users.roles',
                        'icon' => 'fa-solid fa-shield-halved',
                        'active' => 'admin/users/roles*',
                        'permission' => 'users:view'
                    ],
                ]
            ],
            [
                'category' => 'Settings',
                'items' => [
                    [
                        'label' => 'Property Settings',
                        'route' => 'admin.hotels.index',
                        'icon' => 'fa-solid fa-sliders',
                        'active' => 'admin.hotels.*',
                        'permission' => 'hotels:view'
                    ],
                ]
            ],
        ];
    }

    /**
     * Check if a menu item is active.
     */
    public static function isActive($pattern): bool
    {
        if (str_contains($pattern, '*')) {
            return Request::is($pattern) || Request::routeIs($pattern);
        }
        
        return Request::is($pattern) || Request::routeIs($pattern);
    }
}
