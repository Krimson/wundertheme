wundertheme
===========

Wunderkraut Belgium starter theme.

Requirements
===========

- [npm => 2.10.0](https://nodejs.org) (see below)
- bower => 1.7.2 `$ sudo npm install -g bower@1.7.2`
- gulp-cli => 1.2.0 `$ sudo npm install -g gulp-cli@1.2.0`

Installing node/npm
===================
Debian: `$ curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash - && sudo apt-get install --yes nodejs`
OSX: get the installer from https://nodejs.org/en/#download
Windows: errrr...

Installing dependencies
=======================
Once node (and npm, which comes with it) is installed, run `$ npm install`. This will fetch all required dependencies and put them in a node_modules folder (which should be .gitignor-ed). Running this again doesn't hurt and might be required if any new dependencies were added.

Build
=====
The default task is set up for production builds, so simply running `$ gulp` should compile and compress everything needed without running a watcher or anything.

Development
=========
For use during active development, run `$ gulp dev`. This will run a watcher and host a browsersync proxy for testing on multiple devices.

Deployment
==========
See build.
