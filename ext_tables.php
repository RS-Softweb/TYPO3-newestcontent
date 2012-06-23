<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Newest Content Elements'
);

//$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$extensionName = $_EXTKEY;
$pluginSignature = strtolower($extensionName) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_teaser.xml');
t3lib_extMgm::addLLrefForTCAdescr('tt_content.pi_flexform.'.$pluginSignature.'.list', 'EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_flexform_csh.xml');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Newest Content Elements');

$tmp_newestcontent_columns = array(
	'teaser_text' => array(
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.teaser_text',
		'config' => array(
			'type' => 'text',
			'cols' => '48',
			'rows' => '5',
			'wizards' => array(
				'_PADDING' => 4,
				'_VALIGN' => 'middle',
				'RTE' => array(
					'notNewRecords' => 1,
					'RTEonly' => 1,
					'type' => 'script',
					'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.RTE',
					'icon' => 'wizard_rte2.gif',
					'script' => 'wizard_rte.php',
				),
				'table' => array(
					'notNewRecords' => 1,
					'enableByTypeConfig' => 1,
					'type' => 'script',
					'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.table',
					'icon' => 'wizard_table.gif',
					'script' => 'wizard_table.php',
					'params' => array(
						'xmlOutput' => 0,
					),
				),
				'forms' => array(
					'notNewRecords' => 1,
					'enableByTypeConfig' => 1,
					'type' => 'script',
#						'hideParent' => array('rows' => 4),
					'title' => 'LLL:EXT:cms/locallang_ttc.xml:bodytext.W.forms',
					'icon' => 'wizard_forms.gif',
					'script' => 'wizard_forms.php?special=formtype_mail',
					'params' => array(
						'xmlOutput' => 0,
					),
				),
			),
			'softref' => 'typolink_tag,images,email[subst],url',
		),
	),
);

t3lib_extMgm::addTCAcolumns('tt_content',$tmp_newestcontent_columns);

$TCA['tt_content']['columns'][$TCA['tt_content']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tt_content.tx_extbase_type.Tx_Newestcontent_Content','Tx_Newestcontent_Content');

$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] = $TCA['tt_content']['types']['1']['showitem'];
$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] .= ',--div--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content,';
$TCA['tt_content']['types']['Tx_Newestcontent_Content']['showitem'] .= 'teaser_text';

?>