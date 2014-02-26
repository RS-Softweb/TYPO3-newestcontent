<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013-2014 Rene <typo3@rs-softweb.de>
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
class Tx_Newestcontent_Controller_NewestController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * pageRepository
	 * @var Tx_Newestcontent_Domain_Repository_PageRepository
	 */
	protected $pageRepository;

	/**
	 * contentRepository
	 * @var Tx_Newestcontent_Domain_Repository_ContentRepository
	 */
	protected $contentRepository;

	/**
	 * Current page UID
	 * @var integer
	 */
	protected $currentPageUid;

	/**
	 * injectPageRepository
	 * @param Tx_Newestcontent_Domain_Repository_PageRepository $pageRepository
	 * @return void
	 */
	public function injectPageRepository(Tx_Newestcontent_Domain_Repository_PageRepository $pageRepository) {
		$this->pageRepository = $pageRepository;
	}

	/**
	 * injectContentRepository
	 * @param Tx_Newestcontent_Domain_Repository_ContentRepository $contentRepository
	 * @return void
	 */
	public function injectContentRepository(Tx_Newestcontent_Domain_Repository_ContentRepository $contentRepository) {
		$this->contentRepository = $contentRepository;
	}

	/**
	 * action list
	 * @return void
	 */
	public function listAction() {
		// Get the current page uid for later use
		$this->currentPageUid = $GLOBALS['TSFE']->id;
		
		switch ($this->settings['pages']) {
			default:
			case 'this':
				$this->pageRepository->selectByUidList($this->currentPageUid);
				break;
			case 'thisR':
				$this->pageRepository->selectByUidListRecursive($this->currentPageUid);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				if ($this->settings['pagesExcludeR']) {
					$this->pageRepository->filterByUidListRecursive($this->settings['pagesExcludeR']);
				}
				break;
			case 'thisChildren':
				$this->pageRepository->selectByPidList($this->currentPageUid);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				break;
			case 'thisChildrenR':
				$this->pageRepository->selectByPidListRecursive($this->currentPageUid);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				if ($this->settings['pagesExcludeR']) {
					$this->pageRepository->filterByUidListRecursive($this->settings['pagesExcludeR']);
				}
				break;
			case 'custom':
				$this->pageRepository->selectByUidList($this->settings['pagesCustom']);
				break;
			case 'customR':
				$this->pageRepository->selectByUidListRecursive($this->settings['pagesCustom']);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				if ($this->settings['pagesExcludeR']) {
					$this->pageRepository->filterByUidListRecursive($this->settings['pagesExcludeR']);
				}
				break;
			case 'customChildren':
				$this->pageRepository->selectByPidList($this->settings['pagesCustom']);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				if ($this->settings['pagesExcludeR']) {
					$this->pageRepository->filterByUidListRecursive($this->settings['pagesExcludeR']);
				}
				break;
			case 'customChildrenR':
				$this->pageRepository->selectByPidListRecursive($this->settings['pagesCustom']);
				if ($this->settings['pagesExclude']) {
					$this->pageRepository->filterByUidList($this->settings['pagesExclude']);
				}
				if ($this->settings['pagesExcludeR']) {
					$this->pageRepository->filterByUidListRecursive($this->settings['pagesExcludeR']);
				}
				break;
		}

		$this->pageRepository->setShowNavHiddenPages($this->settings['showNavHidden'] == '1');
		$this->pageRepository->setFilterDokTypes(t3lib_div::trimExplode(',', $this->settings['showDokTypes'], TRUE));
		if ($this->settings['hideCurrentPage'] == '1') {
			$this->pageRepository->filterByUidList($this->currentPageUid);
		}

		$pages = $this->pageRepository->executeQuery();
		$this->view->assign('pages', $pages);
		$pagesUids = $this->pageRepository->getSelectedPageUids();
		$this->view->assign('pagesUids', $pagesUids);
	}
}
?>