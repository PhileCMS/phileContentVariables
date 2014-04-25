phileContentVariables
=====================

A plugin for [Phile](https://github.com/PhileCMS/Phile) to add custom variables in your content before it is parsed.

### 1.1 Installation (composer)
```
php composer.phar require phile/content-variables:*
```

### 1.2 Installation (Download)

* Install the latest version of [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/contentVariables`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

```
$config['plugins']['phile\\contentVariables'] = array('active' => true);
```

* add an array called `variables` in your `$config` array.

### Usage

You **must have** a `variables` array in your config.

```php
$config['variables'] = array(
  'site_title' => $config['site_title'],
  'base_url' => \Phile\Utility::getBaseUrl()
);
```

These keys are the variables, and the value is what the replaced string will be. So now when you reference `%base_url%` or `%site_url%` in your markdown/textile/content pages, it will be rendered as your real base URL.

If you base URL was *http://example.com*:

```markdown
This is a link to my [base URL](%base_url%)
```

Will be rendered as:

```html
<p>This is a link to my <a href="http://example.com">base URL</a></p>
```

Another example for a site with the title *PhileCMS*:

```markdown
Welcome to %site_title%!
```

Becomes:

```html
<p>Welcome to PhileCMS!</p>
```


### Config

This plugin allows the open and close tags for your variables to be set. By default they are both set to the following:

```php
'open_tag' => '%', // the open tag for the variable
'close_tag' => '%' // the close tag for the variable
```

This means any text wrapped with `%` signs will be replaced.