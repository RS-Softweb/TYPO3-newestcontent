<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Rene <typo3@rs-softweb.de>
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
 *
 * @package newestcontent
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * $Id$
 * $Rev$
 * $Author$
 * $Date$
 *
 */
class Tx_Newestcontent_Domain_Repository_PageRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * @var Tx_Extbase_Persistence_QueryInterface
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
	 * @return void
	 * @see Tx_Extbase_Persistence_Repository::initializeObject()
	 */
	public function initializeObject() {
		$querySettings = $this->objectManager->create('Tx_Extbase_Persistence_Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
		$this->query = $this->createQuery();
	}

	/**
	 * Set the UIDs of selected pages for further use
	 * @param array|Tx_Extbase_Persistence_QueryResultInterface $queryResult Result of the Query as array
	 * @return void
	 */
	private function setSelectedPageUids($queryResult){
		$this->selectedPageUids = array();
		foreach($queryResult as $page){
			$this->selectedPageUids[] = $page->getUid();
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
	 * Select the given UIDs.
	 * @param string $uidList Comma separated list of UIDs
	 * @return void
	 */
	public function selectByUidList($uidList) {
		$uids = t3lib_div::intExplode(',', $uidList, TRUE);
		$this->addQueryConstraint($this->query->in('uid', $uids));
	}

	/**
	 * Select the given PIDs.
	 * @param string $pidList Comma separated list of PIDs
	 * @return void
	 */
	public function selectByPidList($pidList) {
		$pids = t3lib_div::intExplode(',', $pidList, TRUE);
		$this->addQueryConstraint($this->query->in('pid', $pids));
	}

	/**
	 * Select the given UIDs. Works recursively
	 * @param string $uidList Comma separated list of PIDs
	 * @return void
	 */
	public function selectByUidListRecursive($uidList) {
		$pageUids = $this->getPageListRecursive($uidList, 255);
		$uids = t3lib_div::intExplode(',', $pageUids, TRUE);
		$this->addQueryConstraint($this->query->in('uid', $uids));
	}

	/**
	 * Select the children of the given PIDs. Works recursively
	 * @param string $pidList Comma separated list of PIDs
	 * @return void
	 */
	public function selectByPidListRecursive($pidList) {
		$pagePids = $this->getPageListRecursive($pidList, 255);
		$pids = t3lib_div::intExplode(',', $pagePids, TRUE);
		$this->addQueryConstraint($this->query->in('pid', $pids));
	}

	/**
	 * Filter the given UIDs from the result.
	 * @param string $uidList Comma separated list of UIDs
	 * @return void
	 */
	public function filterByUidList($uidList) {
		$uids = t3lib_div::intExplode(',', $uidList, TRUE);
		$this->addQueryConstraint($this->query->logicalNot($this->query->in('uid', $uids)));
	}

	/**
	 * Filter the given UIDs from the result. Works recursively
	 * @param string $pidList Comma separated list of UIDs
	 * @return void
	 */
	public function filterByUidListRecursive($pidList) {
		$pagePids = $this->getPageListRecursive($pidList, 255);
		$pids = t3lib_div::intExplode(',', $pagePids, TRUE);
		$this->addQueryConstraint($this->query->logicalNot($this->query->in('uid', $pids)));
	}

	/**
	 * Filter the given UIDs from the result.
	 * @param string $$pagesExclude Comma separated list of UIDs
	 * @param string $$pagesExcludeR Comma separated list of UIDs for recursive filtering
	 * @return void
	 */
	public function filterExcluded($pagesExclude=NULL, $pagesExcludeRecursive=NULL) {
		if ($pagesExclude) {
			$this->filterByUidList($pagesExclude);
		}
		if ($pagesExcludeRecursive) {
			$this->filterByUidListRecursive($pagesExcludeRecursive);
		}
	}

	/**
	 * Query also pages that are hidden in navigation
	 * @param boolean $showNavHiddenPages If TRUE lets show items which should not be visible in navigation. Default is FALSE.
	 * @return void
	 */
	public function setShowNavHiddenPages($showNavHiddenPages=FALSE) {
		if ($showNavHiddenPages === TRUE) {
			$this->addQueryConstraint($this->query->equals('nav_hide', array(0,1)));
		} else {
			$this->addQueryConstraint($this->query->equals('nav_hide', array(0)));
		}
	}

	/**
	 * Filter selected pages by this doctypes
	 * @param array $filterDokTypes doktypes as array, may be empty
	 * @return void
	 */
	public function setFilterDokTypes(array $filterDokTypes) {
		if (count($filterDokTypes) > 0) {
			$this->addQueryConstraint($this->query->equals('doktype', $filterDokTypes));
		}
	}

	/**
	 * Create the query constraints and then execute the query
	 * @return array|Tx_Extbase_Persistence_QueryResultInterface Result of query
	 */
	public function executeQuery() {
		$query = $this->query;
		$query->matching($query->logicalAnd($this->queryConstraints));
		$queryResult = $query->execute()->toArray();
		$this->setSelectedPageUids($queryResult);
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
	 * Adds query constraint to array
	 * @param Tx_Extbase_Persistence_QOM_ConstraintInterface $constraint Constraint to add
	 * @return void
	 */
	private function addQueryConstraint(Tx_Extbase_Persistence_QOM_ConstraintInterface $constraint) {
		$this->queryConstraints[] = $constraint;
	}

	/**
	 * Recursively creates a comma-separated list of subpage UIDs from
	 * a list of pages. The result also includes the original pages.
	 * The maximum level of recursion can be limited:
	 * 0 = no recursion (the default value, will return $startPages),
	 * 1 = only direct child pages,
	 * ...,
	 * 250 = all descendants for all sane cases
	 *
	 * @param string comma-separated list of page UIDs to start from, must only contain numbers and commas, may be empty
	 * @param integer maximum depth of recursion, must be >= 0
	 * @return string comma-separated list of subpage UIDs including the UIDs provided in $startPages, will be empty if $startPages is empty
	 * @author Oliver Klee <typo3-coding@oliverklee.de>
	 * @see http://typo3.org/extensions/repository/view/oelib/current/
	 */
	private function getPageListRecursive($startPages, $recursionDepth = 0) {
		if ($recursionDepth == 0) {
			return $startPages;
		}
		if ($startPages == '') {
			return '';
		}
		$dbResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', 'pages', 'pid IN ('. $startPages.')');
		$subPages = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbResult)) {
			$subPages[] = $row['uid'];
		}
		$GLOBALS['TYPO3_DB']->sql_free_result($dbResult);
		if (!empty($subPages)) {
			$result = $startPages . ',' . $this->getPageListRecursive(implode(',', $subPages), $recursionDepth - 1);
		} else {
			$result = $startPages;
		}
		return $result;
	}
}
?>