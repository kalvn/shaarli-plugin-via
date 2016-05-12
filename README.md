# Shaarli Via

Shaarli via is a tiny plugin which offers you the possibility to indicate the original source of a link that you share.

It adds 2 fields in the link edition page for the label and the url of the source.
The source is then displayed at the end of the description (if you provided it, otherwise, nothing appears).

## Installation
### Via Git
If you use git you can run the following command from within the `plugins` folder of your Shaarli installation:

```shell
git clone https://github.com/kalvn/shaarli-plugin-via via
```

### Manually
Create the folder `plugins/via` in your Shaarli installation and copy all the files in it.

## Activation
Then, activate the plugin through the plugin administration panel or edit the `data/config.php` file and add `via` in the array `$GLOBALS['config']['ENABLED_PLUGINS']`. For example, if you already have the Wallabag plugin installed, it'll look like this:

```php
$GLOBALS['config']['ENABLED_PLUGINS'] = array (
  'wallabag',
  'via'
);
```

*Please note that it's a very first version which may need improvements.*