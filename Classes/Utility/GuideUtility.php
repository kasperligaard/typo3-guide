<?php
namespace Tx\Guide\Utility;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 TYPO3 CMS Team
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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

/**
 * GuideUtility
 */
class GuideUtility {

	/**
	 * Registers an Ext.Direct component with access restrictions.
	 *
	 * @param string $tourName Name of the tour
	 * @param string $moduleName Optional: must be <mainmodule> or <mainmodule>_<submodule>
	 * @param string $requireJsModule RequireJs module
	 * @param string $languageLabelFile
	 * @return void
	 */
	public static function registerGuideTour($tourName, $moduleName, $requireJsModule, $languageLabelFile='')
	{
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Guide']['Tours'][$tourName] = array(
			'name' => $tourName,
			'requireJsModule' => $requireJsModule,
			'moduleName' => $moduleName,
			'languageLabelFile' => $languageLabelFile
		);

	}

	public static function getRegisteredGuideTours()
	{
		/**
		 * @todo: check authorization
		 *      check activated
		 */
		
		
		return $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['Guide']['Tours'];
		
		
	}
	
	public function isGuidedTourActivated() {
		return TRUE;
		$backendUser = $this->getBackendUserAuthentication();
		return $backendUser->uc['moduleData']['guide'][$tourName]['disabled'];


		/**
		 * @todo: don't include anything, in case of the user confirmed that he won't restart the guide
		 */
		
		return TRUE;
	}
	
	public function markGuideAsDisabled($tourName, $disabled=TRUE) {
		$backendUser = $this->getBackendUserAuthentication();
		$backendUser->uc['moduleData']['guide'][$tourName]['disabled'] = $disabled;
		$backendUser->writeUC($backendUser->uc);
	}
	/**
	 * @return BackendUserAuthentication
	 */
	protected function getBackendUserAuthentication() {
		return $GLOBALS['BE_USER'];
	}
	
}