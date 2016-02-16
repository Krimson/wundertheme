Wunderkit
---------

Wunderkraut Belgium scaffolding starter kit.

Requirements
------------
- [npm => 3.6.0](https://nodejs.org)
- [bower => 1.7.7](http://bower.io)

Installing node/npm
-------------------
- Debian: `$ curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash - && sudo apt-get install --yes nodejs`
- OSX: get the installer from https://nodejs.org/en/#download

Installing bower
-------------------
- `$ sudo npm install -g bower`

Development dependencies
------------------------
- bower-installer: `$ sudo npm install -g bower-installer`

Getting started
---------------
- Run `$ npm install` from within the project folder. This will fetch all required dependencies and put them in a node_modules folder.

Gulp tasks
----------
The default task is set up for development. Running `$ gulp` will compile your SASS, run a watcher and a browsersync session.

- Default (gulp): Runs SASS, Watch and Browsersync
- Compile (gulp compile): Runs SASS and minifies CSS files (useful for recompiling)

Development
-----------
For use during active development, run `$ gulp`. This will run a watcher and host a browsersync proxy for testing on multiple devices. Newly introduced bower dependencies should be resolved with `$ bower-installer` and the vendor folder should be committed.
