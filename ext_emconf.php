<?php

########################################################################
# Extension Manager/Repository config file for ext "newestcontent".
#
# Auto generated 17-06-2012 16:37
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

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
			'typo3' => '4.5-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:34:{s:21:"ExtensionBuilder.json";s:4:"a4d5";s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"432b";s:14:"ext_tables.php";s:4:"6a16";s:14:"ext_tables.sql";s:4:"3c39";s:24:"ext_typoscript_setup.txt";s:4:"d41d";s:40:"Classes/Controller/ContentController.php";s:4:"cf6c";s:37:"Classes/Controller/PageController.php";s:4:"c419";s:32:"Classes/Domain/Model/Content.php";s:4:"bfe1";s:29:"Classes/Domain/Model/Page.php";s:4:"dd60";s:47:"Classes/Domain/Repository/ContentRepository.php";s:4:"6298";s:44:"Classes/Domain/Repository/PageRepository.php";s:4:"6552";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"71b7";s:29:"Configuration/TCA/Content.php";s:4:"a0fd";s:26:"Configuration/TCA/Page.php";s:4:"a0fd";s:38:"Configuration/TypoScript/constants.txt";s:4:"9bec";s:34:"Configuration/TypoScript/setup.txt";s:4:"eea9";s:40:"Resources/Private/Language/locallang.xml";s:4:"56af";s:55:"Resources/Private/Language/locallang_csh_tt_content.xml";s:4:"dcdd";s:82:"Resources/Private/Language/locallang_csh_tx_newestcontent_domain_model_content.xml";s:4:"7a11";s:79:"Resources/Private/Language/locallang_csh_tx_newestcontent_domain_model_page.xml";s:4:"3635";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"fa6d";s:38:"Resources/Private/Layouts/Default.html";s:4:"727a";s:45:"Resources/Private/Templates/Content/List.html";s:4:"7dbb";s:42:"Resources/Private/Templates/Page/List.html";s:4:"ff4a";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:37:"Resources/Public/Icons/tt_content.gif";s:4:"905a";s:64:"Resources/Public/Icons/tx_newestcontent_domain_model_content.gif";s:4:"905a";s:61:"Resources/Public/Icons/tx_newestcontent_domain_model_page.gif";s:4:"905a";s:47:"Tests/Unit/Controller/ContentControllerTest.php";s:4:"47bb";s:44:"Tests/Unit/Controller/PageControllerTest.php";s:4:"1766";s:39:"Tests/Unit/Domain/Model/ContentTest.php";s:4:"e04a";s:36:"Tests/Unit/Domain/Model/PageTest.php";s:4:"74a5";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>