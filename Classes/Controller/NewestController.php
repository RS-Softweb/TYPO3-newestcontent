<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Rene <typo3@rs-softweb.de>
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
	 * injectPageRepository
	 *
	 * @param Tx_Newestcontent_Domain_Repository_PageRepository $pageRepository
	 * @return void
	 */
	public function injectPageRepository(Tx_Newestcontent_Domain_Repository_PageRepository $pageRepository) {
		$this->pageRepository = $pageRepository;
	}

	/**
	 * injectContentRepository
	 *
	 * @param Tx_Newestcontent_Domain_Repository_ContentRepository $contentRepository
	 * @return void
	 */
	public function injectContentRepository(Tx_Newestcontent_Domain_Repository_ContentRepository $contentRepository) {
		$this->contentRepository = $contentRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$pages = $this->pageRepository->findAll();
		$this->view->assign('pages', $pages);
		$contents = $this->contentRepository->findAll();
		$this->view->assign('contents', $contents);
	}

}
?>