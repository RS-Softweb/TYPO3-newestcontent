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
	'tx_newestcontent_config' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_config',
		'displayCond' => 'FIELD:tx_newestcontent_showasnew:REQ:true',
		'config' => array(
			'type' => 'flex',
			'ds_pointerField' => 'tx_newestcontent_showasnew',
			'ds' => array(
				'default' => '
					<T3DataStructure>
						<meta>
							<langDisable>1</langDisable>
						</meta>
						<ROOT>
							<type>array</type>
							<el>
								<tx_newestcontent_start>
									<TCEforms>
										<label>LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_start</label>
										<config>
											<type>input</type>
											<size>10</size>
											<max>10</max>
											<eval>datetime</eval>
											<checkbox>1</checkbox>
										</config>
									</TCEforms>
								</tx_newestcontent_start>
								<tx_newestcontent_update>
									<TCEforms>
										<label>LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_update</label>
										<config>
											<type>input</type>
											<size>10</size>
											<max>10</max>
											<eval>datetime</eval>
											<checkbox>1</checkbox>
										</config>
									</TCEforms>
								</tx_newestcontent_update>
								<tx_newestcontent_stop>
									<TCEforms>
										<label>LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_stop</label>
										<config>
											<type>input</type>
											<size>10</size>
											<max>10</max>
											<eval>datetime</eval>
										</config>
									</TCEforms>
								</tx_newestcontent_stop>
								<tx_newestcontent_teaser>
									<TCEforms>
										<label>LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xlf:tx_newestcontent_domain_model_content.nce_teaser</label>
										<config>
											<type>text</type>
											<cols>40</cols>
											<rows>5</rows>
										</config>
										<defaultExtras>richtext[*]:rte_transform[mode=ts_css]</defaultExtras>
									</TCEforms>
								</tx_newestcontent_teaser>
							</el>
						</ROOT>
					</T3DataStructure>
				',
			)
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$tmp_newestcontent_columns);

$TCA['tt_content']['ctrl']['requestUpdate'] .= ',tx_newestcontent_showasnew';

$tmp_newestcontent_insert = '';
$tmp_newestcontent_insert .= '--div--;LLL:EXT:newestcontent/Resources/Private/Language/locallang_db.xml:tx_newestcontent_domain_model_content.header,';
$tmp_newestcontent_insert .= 'tx_newestcontent_showasnew,tx_newestcontent_config';
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content',$tmp_newestcontent_insert, '', 'after:header');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content',$tmp_newestcontent_insert, '');

?>