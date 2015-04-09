wundertheme
===========

Wundertheme is a Sass based Drupal starter theme with Bootstrap integration that embodies the Wunderkraut Belgium frontend workflow.

Requirements
===========
To properly work with wundertheme you need:

- Bundler

Build
=====
To compile the CSS, simply run the following from the theme root:

- bundle install && bundle exec compass compile --force

Debugging
=========
To compile with debugging information, simply specify the environment to be development (defaults to production).

- bundle exec compass compile --force --environment=development

Deployment
==========
To ensure the output is as compact as possible, it is possible to force the output style to compressed (should already be using compressed when using production environment and expanded when using development environment)

- bundle exec compass compile --force --environment=production --output-style=compressed
