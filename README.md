![wunderkit](https://cloud.githubusercontent.com/assets/4246645/13176307/6b50ee08-d711-11e5-8b42-fc0fa9c2ea39.jpg)

# Wunderkit

**Wunderkit** is an *opinionated* scaffolding starter kit for web development containing tools for building a great experience across many devices. A solid starting point for quickly scaffolding out a new project.

## Features

| Feature                                | Summary                                                                                                                                                                                                                                                     |
|----------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| [Gulp](http://gulpjs.com) | Build system automating tasks: minification and copying of all JavaScript files, static images, capable of watching files to automatically rerun the task when a file is updated. |
| [Bourbon](http://bourbon.io) | Bourbon is a lightweight Sass mixin library tool set that helps you write more effective stylesheets. |
| [Neat](http://neat.bourbon.io) | A lightweight semantic grid framework for Sass and Bourbon. |
| [Bitters](http://bitters.bourbon.io) | Scaffold styles, variables and structure for Bourbon projects. |                                                                                                                                          |

## Requirements

- [npm](https://nodejs.org)
- [bower](http://bower.io)
- [bower-installer](https://github.com/blittle/bower-installer)

## Installing the requirements

### Node

- Debian: `$ curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash - && sudo apt-get install --yes nodejs`
- OSX: get the installer from https://nodejs.org/en/#download

### Bower

- `$ sudo npm install -g bower`

### Bower-installer

- `$ sudo npm install -g bower-installer`

## Quickstart

Clone this repository and build on what is included in the `src` directory.

From within the project folder:
* Run `$ npm install`: This will fetch all required dependencies and put them in a node_modules folder.
* Run `$ bower install`: This will put all required packages in the bower_components folder.
* Run `$ bower-installer`: Bower-installer will copy the main js and css files over from the bower_components folder and put them in their respective vendor folder.
* Run `$ gulp`: This will run a watcher and host a browsersync proxy for testing on multiple devices.

There is an HTML starting point included (index.html), to demonstrate the Bitters scaffolding styles.

## Gulp tasks

The default task is set up for development.
Running `$ gulp` will compile your SASS, run a watcher and a browsersync session.


Task  | Description
------------- | -------------
**default (gulp)**  | Runs `sass`, `watch` and `browsersync` tasks
**compile** | Runs `sass` and `minify-css` tasks
minify-css | Minifies CSS files for production
sass | Compiles SCSS files to CSS
browser-sync | Keep multiple browsers & devices in sync when building websites
watch | Watch files and folders

## Browser Support

At present, wunderkit supports the last two versions of the following browsers out of the box:

* Chrome
* Edge
* Firefox
* Safari
* Opera
* Internet Explorer 9+

## License

MIT
Copyright 2016 - Wunderkraut Benelux