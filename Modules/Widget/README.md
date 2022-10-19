# Widget module

### This module to manages Widgets (create, update, delete and assign to sidebars)


## Create new widget

To create new wedget class run following command:

```bash
    php artisan make:widget {widget_name}
```
To create wedget in module add following option `module`:
```bash
    php artisan make:widget {widget_name} --module={module_name}
```

### force
To Overide class if exists add following option `force`:
```bash
    php artisan make:widget {widget_name} --module={module_name} --force
```

### Example:
```bash
    php artisan make:widget Text --module=Blog
```