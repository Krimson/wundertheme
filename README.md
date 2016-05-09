# Wundertheme Patternlab

An [atomic design](http://bradfrost.com/blog/post/atomic-web-design/) and [Pattern Lab](http://patternlab.io/) friendly starting point for new Drupal 8 themes.

Defines only four regions: Header, Main, Footer and Off Canvas. Other layout is expected to be implemented using Drupal blocks and a CSS grid framework.

Please note that this theme is in early stages of development.


## Installing development dependencies

While it is possible to use [Wundertheme](https://github.com/Wunderkraut-Benelux/wundertheme) on its own,  [Wundertheme Theme StarterKit](https://github.com/Stalski/starterkit-wundertheme-patternlab) is required for set-up and development.

Prerequisites: [npm](https://nodejs.org/) and [Bower](http://bower.io/) installed.

In the theme root directory run:

```sh
git clone https://github.com/Stalski/starterkit-wundertheme-patternlab starterkit
```

In the `starterkit` directory run:

```sh
npm install
bower install
```


## Files copied from the StarterKit

Please note that the contents of the `css`, `images` and `templates/patterns` directories are copied from the StarterKit and should not be edited. Copies are included in the theme repository for convenience only, so that it is possible to try out the theme on its own.



## Integrating with Pattern Lab

Prerequisites: Shila Drupal Theme StarterKit and [Composer](https://getcomposer.org/) installed.

In the theme root directory run:

```sh
git clone https://github.com/pattern-lab/edition-php-drupal-standard pattern-lab
```

In the `pattern-lab/.npm` directory run:

```sh
composer install
```

In the file `pattern-lab/config/config.yml` change `sourceDir` and `twigAutoescape` like so:

```yml
sourceDir: ../starterkit/dist
twigAutoescape: false
```

If everything went well you should now be able to generate the static Pattern Lab site. In the `pattern-lab` directory run:

```sh
php core/console --generate
```


## License

MIT
Copyright 2016 - Wunderkraut Benelux
