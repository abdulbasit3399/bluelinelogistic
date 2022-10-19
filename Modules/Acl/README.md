# Access control level Module

### This module manages permissions.
- View role list
- Create role
- Edit role
- Add permissions using seeder


## Manage permissions
`See Modules\Acl\Database\Seeders\SeedAllPermissionsTableSeeder.php`
### Add new permissions
- Go to `Modules/{moudle_name}/Config/config.php`
- Add new array with name ***permissions***
- Add new group in ***permissions*** array
- Example:

```php 
   return [
      'permissions' => [
          'posts' => [ // group name
              'view-posts', // permission name
              'read-posts', // permission name
          ]
      ]
   ];
```

### After added your permissions run this command to seed permissions in database
```bash
php artisan permissions:sync
```
-----