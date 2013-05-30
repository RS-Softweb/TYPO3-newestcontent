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
class Tx_Newestcontent_Domain_Model_Content extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * nceShowasnew
	 *
	 * @var boolean
	 */
	protected $nceShowasnew = FALSE;

	/**
	 * nceDescription
	 *
	 * @var string
	 */
	protected $nceDescription;

	/**
	 * nceStart
	 *
	 * @var DateTime
	 */
	protected $nceStart;

	/**
	 * nceUpdate
	 *
	 * @var DateTime
	 */
	protected $nceUpdate;

	/**
	 * nceStop
	 *
	 * @var DateTime
	 */
	protected $nceStop;

	/**
	 * Returns the nceShowasnew
	 *
	 * @return boolean nceShowasnew
	 */
	public function getNceShowasnew() {
		return $this->nceShowasnew;
	}

	/**
	 * Sets the nceShowasnew
	 *
	 * @param boolean $nceShowasnew
	 * @return boolean nceShowasnew
	 */
	public function setNceShowasnew($nceShowasnew) {
		$this->nceShowasnew = $nceShowasnew;
	}

	/**
	 * Returns the nceDescription
	 *
	 * @return string $nceDescription
	 */
	public function getNceDescription() {
		return $this->nceDescription;
	}

	/**
	 * Sets the nceDescription
	 *
	 * @param string $nceDescription
	 * @return void
	 */
	public function setNceDescription($nceDescription) {
		$this->nceDescription = $nceDescription;
	}

	/**
	 * Returns the nceStart
	 *
	 * @return DateTime $nceStart
	 */
	public function getNceStart() {
		return $this->nceStart;
	}

	/**
	 * Sets the nceStart
	 *
	 * @param DateTime $nceStart
	 * @return void
	 */
	public function setNceStart($nceStart) {
		$this->nceStart = $nceStart;
	}

	/**
	 * Returns the nceUpdate
	 *
	 * @return DateTime $nceUpdate
	 */
	public function getNceUpdate() {
		return $this->nceUpdate;
	}

	/**
	 * Sets the nceUpdate
	 *
	 * @param DateTime $nceUpdate
	 * @return void
	 */
	public function setNceUpdate($nceUpdate) {
		$this->nceUpdate = $nceUpdate;
	}

	/**
	 * Returns the nceStop
	 *
	 * @return DateTime $nceStop
	 */
	public function getNceStop() {
		return $this->nceStop;
	}

	/**
	 * Sets the nceStop
	 *
	 * @param DateTime $nceStop
	 * @return void
	 */
	public function setNceStop($nceStop) {
		$this->nceStop = $nceStop;
	}

}
?>