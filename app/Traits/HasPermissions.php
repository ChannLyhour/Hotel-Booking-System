<?php

namespace App\Traits;

use App\Models\Role;

trait HasPermissions
{
    /**
     * Check if user has a specific permission.
     * Format: resource:action
     */
    public function hasPermission(string $resource, ?string $action = null): bool
    {
        if (!$this->role) {
            return false;
        }

        // Super Admin bypass
        if ($this->isSuperAdmin()) {
            return true;
        }

        $permissions = $this->role->permissions_cache ?? [];
        $permissionKey = $action ? "{$resource}:{$action}" : $resource;

        return in_array($permissionKey, $permissions);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $slug): bool
    {
        return $this->role && $this->role->slug === $slug;
    }

    /**
     * Check if user is a Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin') || $this->hasRole('admin');
    }
}
