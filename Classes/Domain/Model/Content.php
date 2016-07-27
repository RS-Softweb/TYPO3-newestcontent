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
 * Content Model
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * colPos
	 * @var integer
	 */
	protected $colPos;

	/**
	 * ctype
	 * @var string
	 */
	protected $ctype;

	/**
	 * header
	 * @var string
	 */
	protected $header;

	/**
	 * subheader
	 * @var string
	 */
	protected $subheader;

	/**
	 * bodytext
	 * @var string
	 */
	protected $bodytext;

	/**
	 * It may contain multiple images, but TYPO3 called this field just "image"
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $image;
	
	/**
	 * date
	 * @var DateTime
	 */
	protected $date;

	/**
	 * crdate
	 * @var DateTime
	 */
	protected $crdate;

	/**
	 * tstamp
	 * @var DateTime
	 */
	protected $tstamp;

	/**
	 * starttime
	 * @var DateTime
	 */
	protected $starttime;

	/**
	 * endtime
	 * @var DateTime
	 */
	protected $endtime;

	/**
	 * nceShowasnew
	 * @var boolean
	 */
	protected $nceShowasnew = FALSE;

	/**
	 * nceConfig
	 * @var string
	 */
	protected $nceConfig;

	/**
	 * nceDescription
	 * @var string
	 */
	protected $nceTeaser;

	/**
	 * nceStart
	 * @var DateTime
	 */
	protected $nceStart;

	/**
	 * nceUpdate
	 * @var DateTime
	 */
	protected $nceUpdate;

	/**
	 * nceStop
	 * @var DateTime
	 */
	protected $nceStop;

	/**
	 * page
	 * @var RsSoftweb\Newestcontent\Domain\Model\Page
	 */
	protected $page;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the colPos
	 * @return integer $colPos
	 */
	public function getColPos() {
		return $this->colPos;
	}
	/**
	 * Sets the colPos
	 * @param integer $colPos
	 * @return void
	 */
	public function setColPos($colPos) {
		$this->colPos = $colPos;
	}

	/**
	 * Returns the CType
	 * @return string $ctype
	 */
	public function getCtype() {
		return $this->ctype;
	}
	/**
	 * Sets the CType
	 * @param string $ctype
	 * @return void
	 */
	public function setCtype($ctype) {
		$this->ctype = $ctype;
	}

	/**
	 * Returns the header
	 * @return string $header
	 */
	public function getHeader() {
		return $this->header;
	}
	/**
	 * Sets the header
	 * @param string $header
	 * @return void
	 */
	public function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * Returns the subheader
	 * @return string $subheader
	 */
	public function getSubheader() {
		return $this->subheader;
	}
	/**
	 * Sets the subheader
	 * @param string $subheader
	 * @return void
	 */
	public function setSubheader($subheader) {
		$this->subheader = $subheader;
	}

	/**
	 * Returns the bodytext
	 * @return string bodytext
	 */
	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * Sets the bodytext
	 * @param string $bodytext
	 * @return void
	 */
	public function setBodytext($bodytext) {
		$this->bodytext = $bodytext;
	}

	/**
	 * Sets the images
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $image) {
		$this->image = $image;
	}

	/**
	 * Returns the images
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage images
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Add image
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image->attach($image);
	}

	/**
	 * Remove image
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image->detach($image);
	}

	/**
	 * Returns image files as array (with all attributes)
	 * @return array
	 */
	public function getImageFiles() {
		$imageFiles = array();
		/** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $image */
		foreach ($this->getImage() as $image) {
			$imageFiles[] = $image->getOriginalResource()->toArray();
		}
		return $imageFiles;
	}

	/**
	 * Returns the nceShowasnew
	 * @return boolean nceShowasnew
	 */
	public function getNceShowasnew() {
		return $this->nceShowasnew;
	}

	/**
	 * Sets the nceShowasnew
	 * @param boolean $nceShowasnew
	 * @return void
	 */
	public function setNceShowasnew($nceShowasnew) {
		$this->nceShowasnew = $nceShowasnew;
	}

	/**
	 * Sets the nceConfig
	 * @param string $nceConfig
	 * @return void
	 */
	public function setNceConfig($nceConfig) {
		$this->nceConfig = $nceConfig;
	}

	/**
	 * Returns the nceConfig
	 * @return string $nceConfig
	 */
	public function getNceConfig() {
		return $this->nceConfig;
	}

	/**
	 * Returns the nceTeaser
	 * @return string $nceTeaser
	 */
	public function getNceTeaser() {
		return $this->nceTeaser;
	}

	/**
	 * Sets the nceTeaser
	 * @param string $nceTeaser
	 * @return void
	 */
	public function setNceTeaser($nceTeaser) {
		$this->nceTeaser = $nceTeaser;
	}

	/**
	 * Returns the nceStart
	 * @return DateTime $nceStart
	 */
	public function getNceStart() {
		return $this->nceStart;
	}

	/**
	 * Sets the nceStart
	 * @param DateTime $nceStart
	 * @return void
	 */
	public function setNceStart($nceStart) {
		$this->nceStart = $nceStart;
	}

	/**
	 * Returns the nceUpdate
	 * @return DateTime $nceUpdate
	 */
	public function getNceUpdate() {
		return $this->nceUpdate;
	}

	/**
	 * Sets the nceUpdate
	 * @param DateTime $nceUpdate
	 * @return void
	 */
	public function setNceUpdate($nceUpdate) {
		$this->nceUpdate = $nceUpdate;
	}

	/**
	 * Returns the nceStop
	 * @return DateTime $nceStop
	 */
	public function getNceStop() {
		return $this->nceStop;
	}

	/**
	 * Sets the nceStop
	 * @param DateTime $nceStop
	 * @return void
	 */
	public function setNceStop($nceStop) {
		$this->nceStop = $nceStop;
	}

	/**
	 * Returns the page
	 * @return \RsSoftweb\Newestcontent\Domain\Model\Page $page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Sets the page
	 * @param \RsSoftweb\Newestcontent\Domain\Model\Page $page
	 * @return void
	 */
	public function setPage(\RsSoftweb\Newestcontent\Domain\Model\Page $page) {
		$this->page = $page;
	}

}
?>