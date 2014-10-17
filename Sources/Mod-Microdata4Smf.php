<?php
/**
 * Project: Microdata 4 SMF
 * Version: 1.0
 * File: Mod-Microdata.php
 * Author: digger
 * License: CC BY-NC-ND 4.0 http://creativecommons.org/licenses/by-nc-nd/4.0/
 */

//http://www.google.com/webmasters/tools/richsnippets
//https://developers.facebook.com/tools/debug/
//https://dev.twitter.com/docs/cards
//http://vk.com/dev/pages.clearCache

if (!defined('SMF'))
    die('Hacking attempt...');

/**
 * Adds mod copyright to the forum credit's page
 */
function addMicrodata4SmfCopyright()
{
    global $context;

    if ($context['current_action'] == 'credits')
        $context['copyrights']['mods'][] = '<a href="http://mysmf.ru/mods/microdata-4-smf" target="_blank">Microdata 4 SMF</a> &copy; 2014, digger';
}


/**
 * Load all needed hooks
 */
function loadMicrodata4SmfHooks()
{
    add_integration_function('integrate_general_mod_settings', 'changeMicrodata4SmfSettings', false);
    add_integration_function('integrate_menu_buttons', 'addMicrodata4SmfCopyright', false);
    add_integration_function('integrate_menu_buttons', 'setMicrodata4SmfMetaOg', false);
    add_integration_function('integrate_menu_buttons', 'setMicrodata4SmfMetaTwitter', false);
    add_integration_function('integrate_admin_areas', 'addMicrodata4SmfAdminArea', false);
    add_integration_function('integrate_modify_modifications', 'addMicrodata4SmfAdminAction', false);
}


function addMicrodata4SmfAdminArea(&$admin_areas)
{
    global $txt;
    loadLanguage('Microdata4Smf/');

    $admin_areas['config']['areas']['modsettings']['subsections']['microdata4smf'] = array($txt['microdata4smf_admin_menu']);
}


function addMicrodata4SmfAdminAction(&$subActions)
{
    $subActions['microdata4smf'] = 'addMicrodata4SmfAdminSettings';
}


/**
 * Generate admin section for mod settings
 * @param $return_config array config vars
 */
function addMicrodata4SmfAdminSettings($return_config = false)
{
    global $txt, $scripturl, $context;
    loadLanguage('Microdata4Smf/');

    $context['page_title'] = $txt['microdata4smf_admin_menu'];
    $context['post_url'] = $scripturl . '?action=admin;area=modsettings;save;sa=microdata4smf';

    $config_vars = array(
        array('title', 'microdata4smf_settings'),
        array('text', 'microdata4smf_logo'),
        array('check', 'microdata4smf_logo_attachment'),
        //array('check', 'microdata4smf_logo_img'),
        array('large_text', 'microdata4smf_description'),
        array('text', 'microdata4smf_twitter'),
    );

    if ($return_config)
        return $config_vars;

    if (isset($_GET['save'])) {
        checkSession();
        saveDBSettings($config_vars);
        redirectexit('action=admin;area=modsettings;sa=microdata4smf');
    }

    prepareDBSettingContext($config_vars);
}


/**
 * Set meta tags for OpenGraph markup
 */
function setMicrodata4SmfMetaOg()
{
    global $context, $attachments, $scripturl, $modSettings, $settings, $txt;

    // Don't set og meta for media pages
    // TODO check if we have Optimus Brave installed
    if ($context['current_action'] == 'media' && !empty($_REQUEST['sa']) && !empty($_REQUEST['in'])) return;

    // Set og:site_name
    $og_site_name = $context['forum_name'];

    // Set og:title
    if (!empty($context['subject'])) $og_title = $context['subject'];
    else if (!empty($context['page_title'])) $og_title = $context['page_title'];
    else if (!empty($context['page_title_html_safe'])) $og_title = $context['page_title_html_safe'];
    else $og_title = $settings['$mbname'];

    // Set og:type
    if (!empty($context['current_topic'])) $og_type = 'article';
    else $og_type = 'website';

    // Set og:image
    // first_message -> topic_first_message
    if (!empty($modSettings['microdata4smf_logo_attachment']) && !empty($context['first_message']) && !empty($attachments[$context['first_message']][0]['width']) && !empty($attachments[$context['first_message']][0]['approved']))
        $og_image = $scripturl . '?action=dlattach;topic=' . $context['current_topic'] . '.0;attach=' . $attachments[$context['first_message']][0]['id_attach'];
    else if (!empty($modSettings['microdata4smf_logo'])) $og_image = trim($modSettings['microdata4smf_logo']);
    else if (!empty($context['header_logo_url_html_safe'])) $og_image = $context['header_logo_url_html_safe'];
    else $og_image = $settings['images_url'] . '/smflogo.png"';

    // Set og:description
    if (!empty($context['is_poll'])) $og_description = $txt['poll'] . ': ' . $context['poll']['question'];
    else if (!empty($context['first_message'])) $og_description = getMicrodata4SmfDescription($context['first_message']);
    else if (!empty($modSettings['microdata4smf_description'])) $og_description = $modSettings['microdata4smf_description'];
    else $og_description = $og_title;
    // TODO Boards description

    // og:updated_time

    // Set og:url if we have canonical
    if (!empty($context['canonical_url']))
        $context['html_headers'] .= '
  <meta property="og:url" content="' . $context['canonical_url'] . '" />';

    $context['html_headers'] .= '
  <meta property="og:site_name" content="' . $og_site_name . '" />
  <meta property="og:title" content="' . $og_title . '" />
  <meta property="og:type" content="' . $og_type . '" />
  <meta property="og:image" content="' . $og_image . '" />
  <meta property="og:description" content="' . $og_description . '" />
  ';
}


/**
 * Set meta tags for Twitter Cards markup
 */
function setMicrodata4SmfMetaTwitter()
{
    global $smcFunc, $context, $modSettings;

    if (empty($modSettings['microdata4smf_twitter'])) return;

    $modSettings['microdata4smf_twitter'] = trim($modSettings['microdata4smf_twitter']);
    if ($smcFunc['substr']($modSettings['microdata4smf_twitter'], 0, 1) != '@') $modSettings['microdata4smf_twitter'] = '@' . $modSettings['microdata4smf_twitter'];

    $context['html_headers'] .= '
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="' . $modSettings['microdata4smf_twitter'] . '">
  <meta name="twitter:creator" content="' . $modSettings['microdata4smf_twitter'] . '">';
}


/**
 * Get topic first message description
 * @param $id_msg
 * @return string description
 */
function getMicrodata4SmfDescription($id_msg)
{
    global $smcFunc;

    $request = $smcFunc['db_query']('', '
			SELECT SUBSTRING(body, 1, 250)
			FROM {db_prefix}messages
			WHERE id_msg = {int:id_msg}
			LIMIT 1',
        array(
            'id_msg' => $id_msg
        )
    );

    list ($description) = $smcFunc['db_fetch_row']($request);
    $smcFunc['db_free_result']($request);

    $description = strip_tags(str_replace(array('<br>', '<br/>', '<br />', '<hr>', '<hr/>', '<hr />'), '. ', parse_bbc($description, false)));

    if ($smcFunc['strlen']($description) < 200) return $description;

    $description = $smcFunc['substr']($description, 0, 197);
    $position = $smcFunc['strpos']($description, ' ', $smcFunc['strlen']($description) - 15);
    $description = $smcFunc['substr']($description, 0, $position);

    return trim($description) . '...';
}