<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tmp_newestcontent_columns = array(
	'tx_newestcontent_showasnew' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_showasnew',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
	'tx_newestcontent_start' => array(
		'displayCond' => 'FIELD:tx_newestcontent_showasnew:REQ:true',
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
	'tx_newestcontent_update' => array(
		'displayCond' => 'FIELD:tx_newestcontent_showasnew:REQ:true',
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
	'tx_newestcontent_stop' => array(
		'displayCond' => 'FIELD:tx_newestcontent_showasnew:REQ:true',
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
	'tx_newestcontent_teaser' => array(
		'displayCond' => 'FIELD:tx_newestcontent_showasnew:REQ:true',
		'exclude' => 0,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_teaser',
		'config' => array(
			'type' => 'text',
			'cols' => 80,
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
		'defaultExtras' => 'richtext[]:rte_transform[mode=ts_css]',
	),
		
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$tmp_newestcontent_columns);

$TCA['tt_content']['ctrl']['requestUpdate'] .= ',tx_newestcontent_showasnew';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content', 'ncedates', 'tx_newestcontent_start, tx_newestcontent_update, tx_newestcontent_stop');

$tmp_newestcontent_insert = '';
$tmp_newestcontent_insert .= '--div--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.header,';
$tmp_newestcontent_insert .= 'tx_newestcontent_showasnew,';
$tmp_newestcontent_insert .= '--palette--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.nce_dateheader;ncedates,';
$tmp_newestcontent_insert .= 'tx_newestcontent_teaser';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content',$tmp_newestcontent_insert, '');

?>