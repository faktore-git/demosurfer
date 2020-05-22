<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '$argon2i$v=19$m=65536,t=16,p=1$T3RLUnllSzlHa2U1VTdtbg$bsrUb0ThPD43KhWIF2ly/gWpcyj6agCzFhGN7pqu9DM'; // demosurfer
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = 'demosurfer';
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = '127.0.0.1';
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = 'demosurfer';
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = 'demosurfer';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = 'TYPO3 (demosurfer)';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['fileCreateMask'] = '0660';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['folderCreateMask'] = '2770';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['createGroup'] = 'apache';

$GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] = '/usr/bin/';
$GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw'] = '/usr/bin/';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';

$GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 1;
