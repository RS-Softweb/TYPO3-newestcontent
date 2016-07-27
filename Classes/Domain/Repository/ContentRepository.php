<?php
namespace RsSoftweb\Newestcontent\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Rene <typo3@rs-softweb.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Content Repository
 */
class ContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\QueryInterface
	 */
	protected $query = NULL;

	/**
	 * Query contraints to use
	 * @var array
	 */
	protected $queryConstraints = array();

	/**
	 * Selected page UIDs
	 * @var array
	 */
	protected $selectedPageUids = array();

	/**
	 * Initializes the repository.
	 *
	 * @return void
	 *
	 * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
	 */
	public function initializeObject() {
		$querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
		$this->query = $this->createQuery();
	}

	/**
	 * Setup the default contraints for the query.
	 * @return void
	 */
	public function setDefaultQueryContraints() {
		$this->addQueryConstraint($this->query->equals('nceShowasnew', TRUE));
	}
	
	/**
	 * Adds query constraint to array
	 * @param Tx_Extbase_Persistence_QOM_ConstraintInterface $constraint Constraint to add
	 * @return void
	 */
	private function addQueryConstraint(\TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface $constraint) {
		$this->queryConstraints[] = $constraint;
	}

	/**
	 * Create the query constraints and then execute the query
	 * @return array Result of query
	 */
	public function executeQuery() {
		$query = $this->query;
		$query->matching($query->logicalAnd($this->queryConstraints));
//$parser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser');  
//$queryParts = $parser->parseQuery($query); 
//\TYPO3\CMS\Core\Utility\DebugUtility::debug($queryParts, 'Query Content');
		$queryResult = $query->execute()->toArray();
		$this->setSelectedPageUids($queryResult);
		$this->afterQueryUpdateFields($queryResult);
		$this->resetQuery(); 
		return $queryResult;
	}

	/**
	 * Resets query and query constraints after execution
	 * @return void
	 */
	private function resetQuery() {
		unset($this->query);
		$this->query = $this->createQuery();
		unset($this->queryConstraints);
		$this->queryConstraints = array();
	}

	/**
	 * Set the UIDs of selected pages for further use
	 * @param array|Tx_Extbase_Persistence_QueryResultInterface $queryResult Result of the Query as array
	 * @return void
	 */
	private function setSelectedPageUids($queryResult){
		$this->selectedPageUids = array();
		foreach($queryResult as $content){
			$this->selectedPageUids[] = $content->getPid();
		}
	}
	
	/**
	 * Return the UIDs of selected pages for further use
	 * @return array
	 */
	public function getSelectedPageUids() {
		return $this->selectedPageUids;
	}
	
	/**
	 * Select the given PIDs.
	 * @param string $pidList Comma separated list of PIDs
	 * @return void
	 */
	public function selectByPagesList($pidList) {
		$this->addQueryConstraint($this->query->in('pid', $pidList));
	}
	
	/**
	 * Reads the flexform data from db field tx_newestcontent_config (nceConfig) and
	 * transfer the data into the corresponding extbase model fields for further use
	 * @param array|Tx_Extbase_Persistence_QueryResultInterface $queryResult Result of the Query as array
	 * @return void
	 */
	private function afterQueryUpdateFields($queryResult) {
		$flexformService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Service\FlexFormService');
		foreach($queryResult as $content) {
			$config = $flexformService->convertFlexFormContentToArray($content->getNceConfig());
			$content->setNceConfig('');
			$content->setNceStart($config['tx_newestcontent_start']);
			$content->setNceUpdate($config['tx_newestcontent_update']);
			$content->setNceStop($config['tx_newestcontent_stop']);
			$content->setNceTeaser($config['tx_newestcontent_teaser']);
		}
		unset($flexformService);
	}
}
?>