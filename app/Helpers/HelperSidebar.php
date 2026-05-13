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
                        'active' => 'admin.dashboard'
                    ],
                    [
                        'label' => 'Reservations',
                        'route' => 'admin.bookings.index',
                        'icon' => 'fa-solid fa-calendar-check',
                        'active' => 'admin.bookings.*'
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
                        'active' => 'admin.rooms.*'
                    ],
                    [
                        'label' => 'Hotel Amenities',
                        'route' => 'admin.amenities.index',
                        'icon' => 'fa-solid fa-sparkles',
                        'active' => 'admin.amenities.*'
                    ],
                    [
                        'label' => 'Room Types',
                        'route' => 'admin.room-types.index',
                        'icon' => 'fa-solid fa-tags',
                        'active' => 'admin.room-types.*'
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
                        'active' => 'admin/users' // Using URI pattern for some
                    ],
                    [
                        'label' => 'Guest Records',
                        'route' => 'admin.users.guests',
                        'icon' => 'fa-solid fa-hospital-user',
                        'active' => 'admin/users/guests'
                    ],
                    [
                        'label' => 'Staff Directory',
                        'route' => 'admin.users.staff',
                        'icon' => 'fa-solid fa-user-tie',
                        'active' => 'admin/users/staff'
                    ],
                    [
                        'label' => 'Employees',
                        'route' => 'admin.users.employees',
                        'icon' => 'fa-solid fa-people-group',
                        'active' => 'admin/users/employees'
                    ],
                    [
                        'label' => 'Roles & Permissions',
                        'route' => 'admin.users.roles',
                        'icon' => 'fa-solid fa-shield-halved',
                        'active' => 'admin/users/roles'
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
                        'active' => 'admin.hotels.*'
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
            return Request::routeIs($pattern);
        }
        
        return Request::is($pattern) || Request::routeIs($pattern);
    }
}
