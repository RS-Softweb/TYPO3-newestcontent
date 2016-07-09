<?php
namespace RsSoftweb\Newestcontent\Domain\Model;

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
 * Page Model
 */
class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * page title
	 * @var string
	 */
	protected $title;

	/**
	 * page subtitle
	 * @var string
	 */
	protected $subtitle;

	/**
	 * page navtitle
	 * @var string
	 */
	protected $navTitle;

	/**
	 * Setter for title
	 * @param string $title title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Setter for subtitle
	 * @param string $subTitle subtitle
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Getter for subtitle
	 * @return string subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Setter for navTitle
	 * @param string $navTitle navTitle
	 */
	public function setNavTitle($navTitle) {
		$this->navTitle = $navTitle;
	}

	/**
	 * Getter for navTitle
	 * @return string navTitle
	 */
	public function getNavTitle() {
		return $this->navTitle;
	}
}
?>