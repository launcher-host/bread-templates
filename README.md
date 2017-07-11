# Voyager Templates

This package let you use templates with BREAD views. It uses Laravel [Blade
Stacks](https://laravel.com/docs/5.4/blade#stacks) to define each of the template sections where
fields are pushed to.

You can manage Templates with the BREAD system, they are stored on database, and cache files are
generated on disk at `/resources/views/vendor/voyager/templates/{template-slug}.blade.php`.



#### Template Example

Title: `Columns 6/6`

Slug: `columns-6-6`

View:

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


#### JSON Options

```json
{
    "template": {
        "slug":  "columns-6-4",
        "stack": "lf"
    }
}
```



# Usage

#### 1. Choose a Template
When you access Templates, by clicking the menu, you will see 3 templates as default, you can
add or modify any of them.


#### 2. Configure BREAD

Edit the BREAD, and use [JSON Options](#json-options) for defining the template and stack to use.

Notes:
- you may define the `template.slug` only once, on one field.
- fields with no stack parameter are pushed to the bottom.



# Example

To see it in action, Voyager `Pages` is provided as an example.

Make sure you have installed Voyager with dummy data.
