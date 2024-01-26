# Local Development Setup

## Requirements

- [Lando](https://lando.dev) Latest Release
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) Latest Release For Mac and Windows only
- PHP >= 8.2
- Node >= 16.20.1 < 17. You might want to use [nvm](https://github.com/nvm-sh/nvm) to manage your node versions.
- NPM >= 8.2.8

## Setup

- Add `127.0.0.1 rareview.local` to your `hosts` file. [See instructions here](https://www.hostinger.com/tutorials/how-to-edit-hosts-file).
- Run `npm install`.
- Run `npm run setup`.
- Simply run `lando start` to start the environment. You can also run `lando stop` to stop the environment.
- if `wp-config.php` does not exist copy `wp-config.local.php` to `wp-config.php`.
- Login at [http://rareview.local](http://rareview.local) using `lando` and `password`.

## Information

Please note that locally there is no need to use HTTPS.

This project already includes several useful plugins for WordPress local development.

### Npm workspaces
np
1. npm workspaces is used to manage npm dependencies.
The main benefit of using npm workspaces is that we can hoist all dependencies to the root folder and avoid installing duplicate dependencies, saving time and space.
By default, the workspaces config are set up so that wp-content/mu-plugins/rareview are treated as a "package",
if you are building a new plugin/theme make sure to update workspaces in package.json See the example below:


```
    "workspaces": [
        "wp-content/themes/rareview",
    ],
```

2. To build theme simply run `npm install` at the root and `npm run [build|start|watch|hot]` and npm will automatically [build|start|watch|hot] the theme.

3. To add npm dependencies to your plugins add the `-w=workspace-name` flag to the npm install command. E.g: `npm install --save prop-types -w=rareview-theme`
DO NOT RUN `npm install` inside an individual workspace/package. Always run the npm from the root folder.

4. If you're building Gutenberg blocks and importing @wordpress/* packages, you do not need to manually install them as 10up-toolkit will handle these packages properly.

### Building and watching Rareview theme assets

From the root of the repository you can run the `npm run watch`

### Available NPM Commands from the root of the repository

- `npm run start`: An alias for `npm run watch`.
- `npm run test`: Run all tests.
- `npm run setup`: Run the `npm install && npm run build` for all workspaces. This will install dependencies and build assets for the theme.
- `npm run build`: Run the `npm run build` for all workspaces. This will build assets for the theme.
- `npm run watch:theme`: This will build and watch assets for the theme.
- `npm run install:theme`: This will install dependencies for the theme.
- `npm run watch`: This will build and watch assets for all workspaces.
- `npm run watch:hot`: This will build and watch assets for all workspaces with hot reloading.
- `npm run hot`: This will build and watch assets for all workspaces with hot reloading.
- `npm run build-release`: This will build assets for all workspaces for release.
- `npm run lint-release`: This will lint assets for all workspaces for release.
- `npm run format:json`: This will format json files for all workspaces.
- `npm run format:js`: This will format js files for all workspaces.
- `npm run format:css`: This will format css files for all workspaces.
- `npm run format:php`: This will format php files for all workspaces.
- `npm run lint:js`: This will lint js files for all workspaces.
- `npm run lint:json`: This will lint json files for all workspaces.
- `npm run lint:style`: This will lint style files for all workspaces.
- `npm run lint:php`: This will lint php files for all workspaces.
- `npm run lint`: This will lint all files for all workspaces.
- `npm run format`: This will format all files for all workspaces.
- `npm run test:a11y`: This will run accessibility tests for all workspaces.
- `npm run clean-dist`: This will clean the dist folder for all workspaces.

### Committing code

This project uses [husky](https://typicode.github.io/husky/#/) to run git hooks and [lint-staged](https://github.com/lint-staged/lint-staged) to run linting on staged files.

Before committing code, husky will linting commands to ensure that the code is properly formatted. You can bypass these checks by using the `--no-verify` flag when committing code but this is not recommended.
