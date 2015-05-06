<?php
/**
 * @file
 * Provides overrides and additions to aid the theme.
 */

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Adds a placeholder to the search block.
 */
function wundertheme_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['search_block_form']['#attributes']['placeholder'] = t('Search…');
}

/**
 * Implements hook_css_alter().
 */
function wundertheme_css_alter(&$css) {

  /* Remove some default Drupal css */
  $exclude = array(
    'modules/aggregator/aggregator.css' => FALSE,
    'modules/block/block.css' => FALSE,
    'modules/book/book.css' => FALSE,
    'modules/comment/comment.css' => FALSE,
    'modules/dblog/dblog.css' => FALSE,
    'modules/field/theme/field.css' => FALSE,
    'modules/file/file.css' => FALSE,
    'modules/filter/filter.css' => FALSE,
    'modules/forum/forum.css' => FALSE,
    'modules/help/help.css' => FALSE,
    'modules/menu/menu.css' => FALSE,
    'modules/node/node.css' => FALSE,
    'modules/openid/openid.css' => FALSE,
    'modules/poll/poll.css' => FALSE,
    'modules/profile/profile.css' => FALSE,
    'modules/search/search.css' => FALSE,
    'modules/statistics/statistics.css' => FALSE,
    'modules/syslog/syslog.css' => FALSE,
    'modules/system/admin.css' => FALSE,
    'modules/system/maintenance.css' => FALSE,
    'modules/system/system.css' => FALSE,
    'modules/system/system.admin.css' => FALSE,
    'modules/system/system.maintenance.css' => FALSE,
    'modules/system/system.messages.css' => FALSE,
    'modules/system/system.theme.css' => FALSE,
    'modules/system/system.menus.css' => FALSE,
    'modules/taxonomy/taxonomy.css' => FALSE,
    'modules/tracker/tracker.css' => FALSE,
    'modules/update/update.css' => FALSE,
    'modules/user/user.css' => FALSE,
  );

  $css = array_diff_key($css, $exclude);

  /* Get rid of some default panel css */
  foreach ($css as $path => $meta) {
    if (strpos($path, 'threecol_33_34_33_stacked') !== FALSE || strpos($path, 'threecol_25_50_25_stacked') !== FALSE) {
      unset($css[$path]);
    }
  }
}

/**
 * Override or insert variables into the html template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered. This is usually "html", but can
 *   also be "maintenance_page" since zen_preprocess_maintenance_page() calls
 *   this function to have consistent variables.
 */
function wundertheme_preprocess_html(&$variables, $hook) {

  $theme_path = drupal_get_path('theme', 'wundertheme');

  drupal_add_css( $theme_path . '/stylesheets/ie.css',
    array(
      'group' => CSS_THEME,
      'browsers' => array(
        'IE' => 'lt IE 9',
        '!IE' => FALSE,
      ),
      'weight' => 999,
      'every_page' => TRUE,
      'media' => 'screen, projection'
    )
  );
  drupal_add_css( $theme_path . '/stylesheets/style.css',
    array(
      'group' => CSS_THEME,
      'browsers' => array(
        'IE' => 'gt IE 8',
        '!IE' => TRUE,
      ),
      'weight' => 999,
      'every_page' => TRUE,
      'media' => 'screen, projection'
    )
  );
  drupal_add_css( $theme_path . '/stylesheets/print.css',
    array(
      'group' => CSS_THEME,
      'weight' => 999,
      'every_page' => TRUE,
      'media' => 'print'
    )
  );
  $variables['favicon'] = base_path() . $theme_path . '/favicon.ico?v=' . md5_file($theme_path . '/favicon.ico');
}

/**
 * Implements theme_breadcrumb()
 *
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function wundertheme_breadcrumb($variables) {
  $item = menu_get_item();
  $variables['breadcrumb'][] = drupal_get_title();
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $output .= '<div class="breadcrumb">' . implode(' > ', $breadcrumb) . '</div>';

    return $output;
  }
}

/**
 * Implements template_preprocess_button().
 *
 * @param $variables
 * An array of variables to pass to the theme function.
 *
 */
function wundertheme_preprocess_button(&$variables) {
  // Rewrite the drupal classes for buttons so we can consistently theme them.
  $variables['element']['#attributes']['class'][] = 'button';

  if (isset($variables['element']['#value'])) {
    $classes = array(
      //specifics
      t('Save and add') => '',
      t('Add another item') => '',
      t('Add effect') => '',
      t('Add and configure') => '',
      t('Update style') => '',
      t('Download feature') => '',
      //generals
      t('Save') => '',
      t('Apply') => '',
      t('Create') => '',
      t('Confirm') => '',
      t('Submit') => '',
      t('Export') => '',
      t('Import') => '',
      t('Restore') => '',
      t('Rebuild') => '',
      t('Search') => '',
      t('Add') => '',
      t('Update') => '',
      t('Delete') => 'alert',
      t('Remove') => 'alert',
    );
    foreach ($classes as $search => $class) {
      if (strpos($variables['element']['#value'], $search) !== FALSE) {
        $variables['element']['#attributes']['class'][] = $class;
        break;
      }
    }
  }
}

/**
 * Implements hook_html_head_alter().
 *
 * Adds a version string to the favicon for cache-busting.
 */
function wundertheme_html_head_alter(&$elements) {
  $theme_path = drupal_get_path('theme', 'wundertheme');
  foreach ($elements as $id => $value) {
    if (strpos($id, 'favicon') !== FALSE) {
      $elements[$id] .= '?v=' . md5_file($theme_path . '/favicon.ico');
    }
  }
}

/**
 * Implements hook_js_alter().
 *
 * Swaps old jQuery with new (IE compatible) jQuery.
 */
function wundertheme_js_alter(&$js) {
  if (isset($js['misc/jquery.js'])) {
    $path = drupal_get_path('theme', 'wundertheme') . '/js/jquery-1.11.3.min.js';
    $js['misc/jquery.js']['data'] = $path;
  }
}
