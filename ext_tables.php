<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'RsSoftweb.' . $_EXTKEY,
	'Pi1',
	'Newest Content Elements'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_newest.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Newest Content Elements');

$tmp_newestcontent_columns = array(
	'nce_showasnew' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_showasnew',
		'config' => array(
			'type' => 'check',
			'default' => 0
		),
	),
	'nce_description' => array(
		'displayCond' => 'FIELD:nce_showasnew:REQ:true',
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_description',
		'config' => array(
			'type' => 'text',
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
			'wizards' => array(
				'RTE' => array(
					'icon' => 'wizard_rte2.gif',
					'notNewRecords'=> 1,
					'RTEonly' => 1,
					'script' => 'wizard_rte.php',
					'title' => 'LLL:EXT:cms/locallang_ttc.:bodytext.W.RTE',
					'type' => 'script'
				)
			)
		),
		'defaultExtras' => 'richtext[]',
	),
	'nce_start' => array(
		'displayCond' => 'FIELD:nce_showasnew:REQ:true',
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_start',
		'config' => array(
			'type' => 'input',
			'size' => 10,
			'eval' => 'datetime',
			'checkbox' => 1,
			'default' => 0
		),
	),
	'nce_update' => array(
		'displayCond' => 'FIELD:nce_showasnew:REQ:true',
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_update',
		'config' => array(
			'type' => 'input',
			'size' => 10,
			'eval' => 'datetime',
			'checkbox' => 1,
			'default' => 0
		),
	),
	'nce_stop' => array(
		'displayCond' => 'FIELD:nce_showasnew:REQ:true',
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_stop',
		'config' => array(
			'type' => 'input',
			'size' => 10,
			'eval' => 'datetime',
			'checkbox' => 1,
			'default' => 0
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$tmp_newestcontent_columns);
$TCA['tt_content']['ctrl']['requestUpdate'] .= ',nce_showasnew';
$TCA['tt_content']['palettes']['ncedates'] = array();
$TCA['tt_content']['palettes']['ncedates']['showitem'] ='nce_start, nce_update, nce_stop';
$TCA['tt_content']['palettes']['ncedates']['canNotCollapse']='0';
$tmp_fields_insert = '';
$tmp_fields_insert .= '--div--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_teaser,';
$tmp_fields_insert .= 'nce_showasnew,';
$tmp_fields_insert .= '--palette--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_dateheader;ncedates,';
$tmp_fields_insert .= '--palette--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_dateheader;ncedates2,';
$tmp_fields_insert .= 'nce_description';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content',$tmp_fields_insert, '', 'after:header');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tt_content','EXT:newestcontent/Resources/Private/Language/locallang_db_csh.xml');

$TCA['tt_content']['columns'][$TCA['tt_content']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tt_content.tx_extbase_type.Tx_Newestcontent_Content','Tx_Newestcontent_Content');

$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] = $TCA['tt_content']['types']['1']['showitem'];
$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] .= ',--div--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content,';
$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] .= 'nce_showasnew, nce_description, nce_start, nce_update, nce_stop';

?>