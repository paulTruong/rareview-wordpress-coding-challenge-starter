# Rareview Coding Challenge WordPress Theme.

# Information

This theme is based on the [10up theme scaffold](https://github.com/10up/wp-scaffold) repository.

Compiling, minifying, bundling, etc. of JavaScript and CSS is all done by [10up Toolkit](https://github.com/10up/10up-toolkit).
10up Toolkit is included as a dev dependency in this theme. If you want to develop the theme in your console and run `npm run start` (after running `npm install` first of course). Please note this you can also run `npm run start` from the root of this repository.
In the package.json `10up-toolkit.entry` are the paths to CSS/JS files that need to be bundled. Edit these as needed.

## Working with `theme.json`
The default theme scaffold now ships with a very basic version of the `theme.json` file. This is to ensure all the side-affects of introducing this file are there from the beginning of a project and therefore set projects up for success if they want to adopt more features through the `theme.json` mechanism.

### Basics of `theme.json`
The `theme.json` file allows you to take control of your blocks in both the editor and the frontend. The file is structured in a `settings` and a `styles` section where you can define options on a global level and then override them / adjust them on a block level.

The values that you provide in the `theme.json` file will be added both on the frontend and in the editor as [CSS custom properties following a fixed naming scheme](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/#css-custom-properties-presets-custom).



