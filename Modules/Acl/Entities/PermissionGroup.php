<?php

namespace Modules\Acl\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends Model
{

    protected $fillable = [
        'name'
    ];

    /**
	 * Revert permissions collection.
	 * @return Relation
	 */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
