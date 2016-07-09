<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'RsSoftweb.' . $_EXTKEY,
	'Pi1',
	array(
		'Newest' => 'list',
	),
	// non-cacheable actions
	array(
		'Newest' => '',
	)
);

?>