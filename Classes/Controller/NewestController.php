<?php
namespace RsSoftweb\Newestcontent\Controller;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

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
class NewestController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * pageRepository
	 * @var \RsSoftweb\Newestcontent\Domain\Repository\PageRepository
	 * @inject
	 */
	protected $pageRepository;

	/**
	 * contentRepository
	 * @var \RsSoftweb\Newestcontent\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;

	/**
	 * Current page UID
	 * @var integer
	 */
	protected $currentPageUid;

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
				$this->pageRepository->filterExcluded($this->settings['pagesExclude'], $this->settings['pagesExcludeR']);
				break;
			case 'thisChildren':
				$this->pageRepository->selectByPidList($this->currentPageUid);
				$this->pageRepository->filterExcluded($this->settings['pagesExclude']);
				break;
			case 'thisChildrenR':
				$this->pageRepository->selectByPidListRecursive($this->currentPageUid);
				$this->pageRepository->filterExcluded($this->settings['pagesExclude'], $this->settings['pagesExcludeR']);
				break;
			case 'custom':
				$this->pageRepository->selectByUidList($this->settings['pagesCustom']);
				break;
			case 'customR':
				$this->pageRepository->selectByUidListRecursive($this->settings['pagesCustom']);
				$this->pageRepository->filterExcluded($this->settings['pagesExclude'], $this->settings['pagesExcludeR']);
				break;
			case 'customChildren':
				$this->pageRepository->selectByPidList($this->settings['pagesCustom']);
				$this->pageRepository->filterExcluded($this->settings['pagesExclude'], $this->settings['pagesExcludeR']);
				break;
			case 'customChildrenR':
				$this->pageRepository->selectByPidListRecursive($this->settings['pagesCustom']);
				$this->pageRepository->filterExcluded($this->settings['pagesExclude'], $this->settings['pagesExcludeR']);
				break;
		}

		$this->pageRepository->setShowNavHiddenPages($this->settings['showNavHidden'] == '1');
		$this->pageRepository->setFilterDokTypes(GeneralUtility::trimExplode(',', $this->settings['showDokTypes'], TRUE));
		if ($this->settings['hideCurrentPage'] == '1') {
			$this->pageRepository->filterByUidList($this->currentPageUid);
		}

		$pages = $this->pageRepository->executeQuery();
		$pagesUids = $this->pageRepository->getSelectedPageUids();
		$this->view->assign('pages', $pages);
		$this->view->assign('pagesUids', $pagesUids);

		$this->contentRepository->setDefaultQueryContraints();
		$this->contentRepository->selectByPagesList($this->pageRepository->getSelectedPageUids());
		$contents = $this->contentRepository->executeQuery();
		$this->view->assign('contents', $contents);
		$this->combinePagesAndContent($pages, $contents);
	}

	protected function combinePagesAndContent($pages, $contents) {
		$pagesNew = array();
		foreach ($pages as $page) {
			$uid = $page->getUid();
			if (in_array($uid, $this->contentRepository->getSelectedPageUids())) {
				$pagesNew[$uid] = $page;
			}
		}
		foreach ($contents as $content) {
			$pid = $content->getPid();
			$content->setPage($pagesNew[$pid]);
		}
	}
}
?>