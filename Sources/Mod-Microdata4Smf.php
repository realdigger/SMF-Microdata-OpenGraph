<?php
/**
 * Project: Microdata 4 SMF
 * Version: 1.0
 * File: Mod-Microdata.php
 * Author: digger
  * License: CC BY-NC-ND 4.0 http://creativecommons.org/licenses/by-nc-nd/4.0/
 */

if (!defined('SMF'))
    die('Hacking attempt...');

function addMicrodata4SmfCopyright() {
    global $context;

    if ($context['current_action'] == 'credits')
        $context['copyrights']['mods'][] = '<a href="http://mysmf.ru/mods/microdata-4-smf" target="_blank">Microdata 4 SMF</a> &copy; 2014, digger';
}