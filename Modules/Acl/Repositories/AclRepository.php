<?php

namespace Modules\Acl\Repositories;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Modules\Acl\Entities\PermissionGroup;

class AclRepository
{

    public function getPermissionsByGroup()
    {
        return PermissionGroup::with('permissions')->get();
    }

    public function getRoleList()
    {
        return Role::pluck('name');
    }

    public function createRole($data)
    {
        // create a role
        $role = Role::create(['name' => $data['name']]);
        // attach all the permission to role
        $role->syncPermissions($data['permissions']);
        return $role;
    }
    
    public function updateRole($role, $data)
    {
        // create a role
        $role->update(['name' => $data['name']]);
        // attach all the permission to role
        $role->syncPermissions($data['permissions']);
        return $role;
    }
}
