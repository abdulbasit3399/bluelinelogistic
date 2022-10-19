# User Module

### This module manages users.
- View list
- Show profile
- Create
- Edit
- Delete
- Assign permission to user





## Manage permissions
`See Modules\Acl\Database\Seeders\SeedAllPermissionsTableSeeder.php`
### Add new permissions
- Go to `Modules/Users/Config/config.php`
- Add new array with name ***permissions***
- Add new group in ***permissions*** array
- Example:

```php 
   return [
      'permissions' => [
          'users' => [ // group name
              'view-users', // permission name
              'read-users', // permission name
          ]
      ]
   ];
```

### After added your permissions run this command to seed permissions in database
```bash
php artisan permissions:sync
```
-----