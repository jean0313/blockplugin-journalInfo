<?php

/**
 * @file plugins/blocks/journalInfo/JournalInfoBlockPlugin.inc.php
 * Jean
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class JournalInfoBlockPlugin extends BlockPlugin {
	/**
	 * Install default settings on journal creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.block.journalInfo.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.journalInfo.description');
	}

	/**
	 * @see BlockPlugin::getContents
	 */
	function getContents($templateMgr, $request = null) {
		$journal = $request->getJournal();
		if (!$journal) return '';

		$journalName = $journal->getName($journal->getPrimaryLocale());

        $settingsDAO = $journal->getSettingsDAO();
        $journalId = $journal->getId();

        $journalThumbnailInfo = $settingsDAO->getSetting($journalId, "journalThumbnail", $journal->getPrimaryLocale());
        $journalThumbnailName = $journalThumbnailInfo['uploadName'];

		import('classes.file.PublicFileManager');
		$fileManager = new PublicFileManager();
		$journalThumbnailPath = $fileManager->getJournalFilesPath($journalId) . '/'. $journalThumbnailName;

		$templateMgr->assign('journalId', $journalId);
		$templateMgr->assign('journalName', $journalName);
		if ($fileManager->fileExists($journalThumbnailPath)) {
			$templateMgr->assign('journalThumbnailPath', $journalThumbnailPath);
		}

		return parent::getContents($templateMgr, $request);
	}
}

?>
