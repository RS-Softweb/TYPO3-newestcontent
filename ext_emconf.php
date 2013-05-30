<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "newestcontent".
 *
 * Auto generated 30-05-2013 21:56
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Newest Content Elements',
	'description' => '',
	'category' => 'plugin',
	'author' => 'Rene',
	'author_email' => 'typo3@rs-softweb.de',
	'author_company' => '',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'extbase' => '1.3',
			'fluid' => '1.3',
			'typo3' => '4.5-4.7',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:36:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"b798";s:14:"ext_tables.php";s:4:"e8fc";s:14:"ext_tables.sql";s:4:"6804";s:24:"ext_typoscript_setup.txt";s:4:"87ce";s:21:"ExtensionBuilder.json";s:4:"6c70";s:40:"Classes/Controller/ContentController.php";s:4:"3a4e";s:37:"Classes/Controller/PageController.php";s:4:"f072";s:32:"Classes/Domain/Model/Content.php";s:4:"799c";s:29:"Classes/Domain/Model/Page.php";s:4:"1235";s:47:"Classes/Domain/Repository/ContentRepository.php";s:4:"fdaf";s:44:"Classes/Domain/Repository/PageRepository.php";s:4:"2ee3";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"71b7";s:43:"Configuration/FlexForms/flexform_newest.xml";s:4:"7661";s:29:"Configuration/TCA/Content.php";s:4:"a0fd";s:26:"Configuration/TCA/Page.php";s:4:"a0fd";s:38:"Configuration/TypoScript/constants.txt";s:4:"3f85";s:34:"Configuration/TypoScript/setup.txt";s:4:"76cf";s:40:"Resources/Private/Language/locallang.xml";s:4:"2fa8";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"a1d2";s:47:"Resources/Private/Language/locallang_db_csh.xml";s:4:"a2ed";s:49:"Resources/Private/Language/locallang_flexform.xml";s:4:"262e";s:53:"Resources/Private/Language/locallang_flexform_csh.xml";s:4:"ad4e";s:38:"Resources/Private/Layouts/Default.html";s:4:"727a";s:45:"Resources/Private/Templates/Content/List.html";s:4:"905c";s:42:"Resources/Private/Templates/Page/List.html";s:4:"ff4a";s:32:"Resources/Public/Icons/pages.gif";s:4:"905a";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:37:"Resources/Public/Icons/tt_content.gif";s:4:"905a";s:64:"Resources/Public/Icons/tx_newestcontent_domain_model_content.gif";s:4:"905a";s:61:"Resources/Public/Icons/tx_newestcontent_domain_model_page.gif";s:4:"905a";s:47:"Tests/Unit/Controller/ContentControllerTest.php";s:4:"cf12";s:44:"Tests/Unit/Controller/PageControllerTest.php";s:4:"2d90";s:39:"Tests/Unit/Domain/Model/ContentTest.php";s:4:"6c6a";s:36:"Tests/Unit/Domain/Model/PageTest.php";s:4:"b846";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>