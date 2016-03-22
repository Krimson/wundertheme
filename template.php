<?php
/**
 * @file
 * Provides overrides and additions to aid the theme.
 */

/**
 * Implements hook_html_head_alter().
 */
function wundertheme_html_head_alter(&$head_elements) {
  // HTML5 charset declaration.
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8',
  );

  // Optimize mobile viewport.
  $head_elements['mobile_viewport'] = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1',
    ),
  );
}

/**
 * Implements hook_css_alter().
 */
function wundertheme_css_alter(&$css) {
  $exclude = [
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
    'sites/all/modules/contrib/ckeditor/css/ckeditor.css' => FALSE,
    'sites/all/modules/contrib/panels/css/panels.css' => FALSE,
    'sites/all/modules/contrib/views/css/views.css' => FALSE,
    'sites/all/modules/contrib/ctools/css/ctools.css' => FALSE,
  ];

  $css = array_diff_key($css, $exclude);
  
  // Force css files to "link"
  foreach ($css as $key => $value) {
    if (file_exists($value['data'])) {
      // This option forces embeding with a link element.
      // Needed so browsersync will behave
      $css[$key]['preprocess'] = FALSE;
    }
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
 * Implements hook_js_alter().
 *
 * Moves scripts to footer
 * For new jquery version, the jQuery update module should be used
 */
function wundertheme_js_alter(&$js) {
  // Collect the scripts we want in to remain in the header scope.
  $header_scripts = [];

  // Change the default scope of all other scripts to footer.
  // We assume if the script is scoped to header it was done so by default.
  foreach ($js as $key => &$script) {
    if ($script['scope'] == 'header' && !in_array($script['data'], $header_scripts)) {
      $script['scope'] = 'footer';
    }
  }
}
