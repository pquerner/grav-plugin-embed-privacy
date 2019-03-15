# Embed Privacy Plugin

The **Embed Privacy** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Hides embedded content until user activly clicks on. Useful to embed 3rd party sited like Twitter.

## Installation

Installing the Embed Privacy plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install embed-privacy

This will install the Embed Privacy plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/embed-privacy`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `embed-privacy`. You can find these files on [GitHub](https://github.com/pquerner/grav-plugin-embed-privacy) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/embed-privacy
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/embed-privacy/embed-privacy.yaml` to `user/config/plugins/embed-privacy.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
iframely_enabled: true|false
iframely_baseurl: URL of hosted iframely or paid version.
```

Note that if you use the admin plugin, a file with your configuration, and named embed-privacy.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

Configure a iframely base URL, ie. host it yourself or go for the paid version. 
See https://iframely.com/ for more information.

Add content you'd like to only show when the user clicks on it like so:

```
{{ embedprivacy("https://www.youtube.com/watch?v=oxaAjgfYMc4") }}

{{ embedprivacy("https://twitter.com/UploadVR/status/1061115817947873281") }}

{{ embedprivacy("https://vimeo.com/76979871") }}
```

This is how it'll look in the frontend:

![](https://github.com/pquerner/grav-plugin-embed-privacy/blob/master/assets/screenshots/1.png?raw=true)

After the user clicks on it, the content will be loaded.

![](https://github.com/pquerner/grav-plugin-embed-privacy/blob/master/assets/screenshots/2.png?raw=true)


## Credits

In the background I use iframely. Thanks goes to them especially!

