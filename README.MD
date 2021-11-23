<p><img src="http://tailpress.io/images/tailpress100.svg" width="260" alt="TailPress"></p>

# Introduction

This Tailpress fork is based off the original Tailpress but with some extra helper functions and Carbon Fields setup for easy addition of custom fields.

## Getting started

- Clone repo `git clone https://github.com/jeffreyvr/tailpress.git && cd tailpress`
- Run `rm -rf .git` to remove git (or `rmdir .git` for Windows)
- Run `npm install`
- run `composer install` to installing carbon fields
- Run `npm run watch` to start developing
- Follow the instructions at the bottom to fix the CF error if you get it

### General

TailPress uses the [Tailwind CLI](https://tailwindcss.com/docs/installation#using-tailwind-cli), [PostCSS](https://postcss.org) and [esbuild](https://esbuild.github.io).

[Tailwind CSS JIT](https://tailwindcss.com/docs/just-in-time-mode#enabling-jit-mode) is used to allow for fast compiling.

You will find the editable CSS and Javascript files within the `/resources` folder.

Before you use your theme in production, make sure you run `npm run production`.

## NPM Scripts

There are several NPM scripts available. You'll find the full list in the `package.json` file onder "scripts". A script is executed through the terminal by running `npm run script-name`.

| Script     | Description                                                                                                                                      |
| ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------ |
| production | Creates a production (minified) build of app.js, app.css and editor-style.css. and saves it one folder up from the root as a zip file using gulp |
| dev        | Creates a development build of app.js, app.css and editor-style.css.                                                                             |
| watch      | Runs several watch scripts concurrently.                                                                                                         |
| watch-sync | Runs several watch scripts concurrently and starts `browser-sync`.                                                                               |

## Block editor support

TailPress comes with support for the [block editor](https://wordpress.org/support/article/wordpress-editor/).

A basic setup for `theme.json` is included. This also means that you need to at least use WordPress 5.8. If you wan't to support earlier WordPress versions, you can use an [older version](https://github.com/jeffreyvr/tailpress/tree/0.1.1) of TailPress instead.

CSS-classes for alignment (full, wide etc.) are generated automatically. You can opt-out on this by removing the plugin from the `tailwind.config.js` file.

To make the editing experience within the block editor more in line with the front end styling, a `editor-style.css` is generated.

### Define theme colors and font sizes

Several colors and font sizes are defined from the beginning. You can modify the colors in `theme.json`.

## PurgeCSS

By default, PurgeCSS is enabled. You can modify or disable it by changing the settings in the `tailwind.config.js` file. There are several [PurgeCSS options](https://tailwindcss.com/docs/optimizing-for-production#purge-css-options).

## Links

- [TailPress website](https://tailpress.io)
- [Screencasts](https://www.youtube.com/playlist?list=PL6GBdOp044SHIOSCZejodwr1HcYsC43wG)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Esbuild Documentation](https://esbuild.github.io)

## Fixing Carbon Enqueue Error

https://github.com/htmlburger/carbon-fields/issues/743

On line 215 of /htmlburger/core/Container/Block_Container.php update to the following

wp_style_is( $handle, 'registered' )

## Carbon Fields Documentation

https://docs.carbonfields.net/
