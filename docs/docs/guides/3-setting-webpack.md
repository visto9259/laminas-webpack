---
id: laminas-webpack-guide-setting-webpack
title: Setting up the Webpack bundler
sidebar_label: Setting up the Webpack bundler
---
>This is not a guide on Webpack bundling. I recommend this excellent [answer](https://stackoverflow.com/questions/43436754/using-webpack-with-an-existing-php-and-js-project)
 on Stackoverflow by [Loilo](https://github.com/Loilo) to get you started on using Webpack 
 and, obviously, reading the Webpack [documentation](https://webpack.js.org/concepts/) helps a lot.   

## Webpack configuration
    
As [Loilo](https://github.com/Loilo) suggests, I keep my Webpack config files in the `build` folder like this: 

````
.
+--browser
|  +--build
|  |  config.base.js
|  |  config.developement.js
|  |  config.production.js
|  |  paths.js
|  +--src
|    +--lib
|    |  common-code.js
|    +--mymodule
|       +--mycontroller
|          index.js
|          details.js
|          edit.js
+--...
````
 
 I configure Webpack to output the bundles to the `public/dist` folder and to use 
 `/dist/` as the `publicPath`.  I also configure Webpack to also output any assets and css in `public/dist`.
 
`paths.js`

````javascript
const path = require('path');

module.exports = {
    SRC: path.resolve(__dirname, '..', 'src'),
    DIST: path.resolve(__dirname, '..','..','public','dist'),
    ASSETS: '/dist/',
};
````

`config.development.js`
````javascript
const merge = require('webpack-merge');

module.exports = merge(require('./config.base'), {
    mode: 'development',
    watch: true,
    devtool: 'inline-source-map',
});
````

`config.base.js`
````javascript
const path = require('path');
const {SRC, DIST, ASSETS} = require('./paths');
const webpack = require('webpack');

// If you need JQuery, this is how to do it
new webpack.ProvidePlugin({
    $: "jquery",
    jQuery: "jquery",
});

module.exports = {
    entry: {
        main: path.resolve(SRC, 'index.js'),
        'application.index': path.resolve(SRC, 'application/index.js')
    },
    output: {
        path: DIST,
        filename: '[name].js',
        publicPath: ASSETS
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {loader: 'style-loader', options: { injectType: 'linkTag'}},
                    {loader: 'file-loader', options: {
                        name: '[name].[ext]',
                            outputPath: 'css'
                    }},
                ]
            },
            {
                test: /\.(gif|png|jpg|jpeg)$/,
                loaders:[
                    {loader: 'file-loader', options: {name: '[name].[ext]', outputPath: 'css'}}
                ]
            }
        ]
    },
    optimization: {
        splitChunks: {
            chunks: 'all',
            maxInitialRequests: Infinity,
            minSize: 0,
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/]/,
                    name(module) {
                        // Get the name. e.g. node_modules/packageName/not/this/part.js
                        // or node_modules/packageName
                        const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];
                        return `npm.${packageName.replace('@','')}`;
                    }
                }
            }
        }
    },

    plugins: [
    ]
};
````
This seems like a lot to digest but if you are familiar with Webpack, it should make sense.

This will generate the following files in the `public/dist` folder:

````
...
+--public
|  +--dist
|    +--assets
|    |  <your asset files>
|    +--css
|    |  <your css files>
|    index.js
|    application.index.js
|    npm.bootstrap.js
|    npm.jquery.js
|    npm.popper.js.js
+--...
````
 But you still have the complexity of figuring out which scripts goes with which view 
 template. Fortunately, you can add plugins to webpack to generate a manifest linking entry points to bundles.

## Generating a manifest of your bundles

I have written a Webpack plugin that generates a simple manifest in a PHP associative array.

The plugin is called [@visto9259/php-webpack-plugin](https://github.com/visto9259/php-webpack-plugin).

By adding the plugin to the `config.base.js` file like this:
````javascript
const path = require('path');
const {SRC, DIST, ASSETS} = require('./paths');
const webpack = require('webpack');

const PhpWebpackPlugin = require('@visto9259/php-webpack-plugin');

// If you need JQuery, this is how to do it
new webpack.ProvidePlugin({
    $: "jquery",
    jQuery: "jquery",
});

module.exports = {
    entry: {
        main: path.resolve(SRC, 'index.js'),
        'application.index': path.resolve(SRC, 'application/index.js')
    },
    output: {
        path: DIST,
        filename: '[name].js',
        publicPath: ASSETS
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {loader: 'style-loader', options: { injectType: 'linkTag'}},
                    {loader: 'file-loader', options: {
                        name: '[name].[ext]',
                            outputPath: 'css'
                    }},
                ]
            },
            {
                test: /\.(gif|png|jpg|jpeg)$/,
                loaders:[
                    {loader: 'file-loader', options: {name: '[name].[ext]', outputPath: 'css'}}
                ]
            }
        ]
    },
    optimization: {
        splitChunks: {
            chunks: 'all',
            maxInitialRequests: Infinity,
            minSize: 0,
            cacheGroups: {
                vendor: {
                    test: /[\\/]node_modules[\\/]/,
                    name(module) {
                        // Get the name. e.g. node_modules/packageName/not/this/part.js
                        // or node_modules/packageName
                        const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];
                        return `npm.${packageName.replace('@','')}`;
                    }
                }
            }
        }
    },

    plugins: [
        new PhpWebpackPlugin(),
    ]
};
````

Webpack will generate a `scriptlist.php` file in the `public/dist` folder.

````php
<?php
return [
	'main' => [
		'npm.bootstrap' =>  '/dist/npm.bootstrap.js',
		'npm.jquery' =>  '/dist/npm.jquery.js',
		'npm.popper.js' =>  '/dist/npm.popper.js.js',
		'npm.style-loader' =>  '/dist/npm.style-loader.js',
		'npm.webpack' =>  '/dist/npm.webpack.js',
		'main' =>  '/dist/main.js',
	],
	'application.index' => [
		'npm.bootstrap' =>  '/dist/npm.bootstrap.js',
		'npm.jquery' =>  '/dist/npm.jquery.js',
		'npm.popper.js' =>  '/dist/npm.popper.js.js',
		'npm.style-loader' =>  '/dist/npm.style-loader.js',
		'npm.webpack' =>  '/dist/npm.webpack.js',
		'application.index' =>  '/dist/application.index.js',
	],
];
````
 This file can then be consumed in the Laminas application to match the list of scripts in the bundle of each entry point.
 
The next step is to set up your Laminas application to consume the manifest.
