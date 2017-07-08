# About Voyager Templates
Make use of templates with BREAD views, so you don't have to repeat and maintain extra code.

Templates are saved on database, when the Service Provider starts, it will generate all templates in cache, using the Laravel blade system.


# How to use

Go to templates, you will see 3 examples, they all have in common the `@stack()` method (read about Laravel @stack).
The stack() is used to create each of the template zones, where fields are placed.
For defining where to place each field, edit the BREAD, and apply the JSON options.


## Template Example
Title: Columns 6/6
Slug: columns-6-6
HTML:
```html
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="panel panel-bordered">@stack("lf")</div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <div class="panel panel-bordered">@stack("rg")</div>
    </div>
</div>
```

## JSON Options Example
```json
{
    "template": {
        "slug":  "columns-6-4",
        "stack": "lf"
    }
}
```


# Installation
```bash
php artisan hook:install voyager-templates
```

# Publishing
```bash
php artisan vendor:publish --provider='akazorg\VoyagerTemplates\VoyagerTemplatesServiceProvider'
```
