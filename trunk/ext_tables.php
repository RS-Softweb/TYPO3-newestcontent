<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_newestcontent_publishnew' => array (		## WOP:[fields][1][fields][3][fieldname]
		'exclude' => 0,		## WOP:[fields][1][fields][3][excludeField]
		'label' => 'LLL:EXT:newestcontent/locallang_db.xml:tt_content.tx_newestcontent_publishnew',		## WOP:[fields][1][fields][3][title]
		'config' => array (
			'type' => 'check',
		)
	),
	'tx_newestcontent_publishdate' => array (		## WOP:[fields][1][fields][2][fieldname]
		'exclude' => 0,		## WOP:[fields][1][fields][2][excludeField]
		'label' => 'LLL:EXT:newestcontent/locallang_db.xml:tt_content.tx_newestcontent_publishdate',		## WOP:[fields][1][fields][2][title]
		'config' => array (
			'type'     => 'input',
			'size'     => '12',
			'max'      => '20',
			'eval'     => 'datetime',
			'checkbox' => '0',
			'default'  => '0'
		)
	),
	'tx_newestcontent_shorttext' => array (		## WOP:[fields][1][fields][1][fieldname]
		'exclude' => 0,		## WOP:[fields][1][fields][1][excludeField]
		'label' => 'LLL:EXT:newestcontent/locallang_db.xml:tt_content.tx_newestcontent_shorttext',		## WOP:[fields][1][fields][1][title]
		'config' => array (
			'type' => 'text',
			'cols' => '30',
			'rows' => '5',
		)
	),
);


t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_content','tx_newestcontent_publishnew;;;;1-1-1, tx_newestcontent_publishdate, tx_newestcontent_shorttext;;;richtext[]:rte_transform[mode=ts]');


## WOP:[pi][1][addType]
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] ='pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY . '/flexform.xml');

## WOP:[pi][1][addType]
t3lib_extMgm::addPlugin(array(
	'LLL:EXT:newestcontent/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


## WOP:[pi][1][plus_wiz]:
if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_newestcontent_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_newestcontent_pi1_wizicon.php';
}

## WOP:[ts][1]
t3lib_extMgm::addStaticFile($_EXTKEY,'static//', 'Newest Content');
?>
