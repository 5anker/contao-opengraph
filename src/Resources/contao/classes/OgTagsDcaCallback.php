<?php

namespace Anker\OpenGraphBundle;

use Contao\Backend;
use Contao\DC_Table;

class OgTagsDcaCallback extends Backend
{

	/**
	 * @var array
	 */
	protected $saveValues = [];

	/**
	 * @var array
	 */
	protected $existingValues = null;
	protected $pageTitle = '';
	protected $pageDescription = '';

	/**
	 * @param DC_Table $DC
	 * @return void
	 */
	public function saveOgTags(DC_Table $DC)
	{
		$values = '';
		if (is_array($this->saveValues) && !empty($this->saveValues)) {
			$values = serialize($this->saveValues);
		}

		$query = "UPDATE tl_page ".
					"SET ogTags = ? ".
					"WHERE id = ? ";
		$this->Database->prepare($query)->execute($values, $DC->id);
	}

	/**
	 * @param mixed $varValue
	 * @param DC_Table $DC
	 * @return string
	 */
	public function pretendSavingField($varValue, DC_Table $DC)
	{
		$varValue = htmlspecialchars((string)$varValue);
		$this->saveValues[$DC->field] = $varValue;

		return '';
	}

	/**
	 * @param DC_Table $DC
	 * @return void
	 */
	protected function loadExistingValues(DC_Table $DC)
	{
		if ($this->existingValues === null) {
			$query = "SELECT ogTags, pageTitle, title, description ".
						"FROM tl_page ".
						"WHERE id = ? ";
			$DbResult = $this->Database->prepare($query)->execute($DC->id);
			if ($DbResult->numRows > 0) {
				$DbResult->next();

				$this->existingValues = $DbResult->ogTags != '' ? unserialize($DbResult->ogTags) : [];
				$this->pageTitle = $DbResult->pageTitle ?: $DbResult->title;
				$this->pageDescription = $DbResult->description ?: $DbResult->description;
			}

			if (!isset($this->existingValues) || !is_array($this->existingValues)) {
				$this->existingValues = [];
			} else {
				foreach ($this->existingValues as $key => $value) {
					$value = htmlspecialchars_decode((string)$value, ENT_QUOTES);
					$this->existingValues[$key] = $value;
				}
			}
		}
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadTitle($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['ogTitle']) ? (empty((string)$this->existingValues['ogTitle']) ? $this->pageTitle : (string)$this->existingValues['ogTitle']) : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadDescription($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['ogDescription']) ? (empty((string)$this->existingValues['ogDescription']) ? $this->pageDescription : (string)$this->existingValues['ogDescription']) : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadDeterminer($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['ogDeterminer']) ? (string)$this->existingValues['ogDeterminer'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadLocale($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['ogLocale']) ? (string)$this->existingValues['ogLocale'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadLocaleAlternate($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['ogLocaleAlternate']) ? (string)$this->existingValues['ogLocaleAlternate'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicDuration($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicDuration']) ? (string)$this->existingValues['musicDuration'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicAlbum($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicAlbum']) ? (string)$this->existingValues['musicAlbum'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicAlbumDisc($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicAlbumDisc']) ? (string)$this->existingValues['musicAlbumDisc'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicAlbumTrack($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicAlbumTrack']) ? (string)$this->existingValues['musicAlbumTrack'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicAlbumMusician($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicAlbumMusician']) ? (string)$this->existingValues['musicAlbumMusician'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicReleaseDate($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicReleaseDate']) ? (string)$this->existingValues['musicReleaseDate'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadMusicCreator($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['musicCreator']) ? (string)$this->existingValues['musicCreator'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoActor($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoActor']) ? (string)$this->existingValues['videoActor'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoActorRole($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoActorRole']) ? (string)$this->existingValues['videoActorRole'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoDirector($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoDirector']) ? (string)$this->existingValues['videoDirector'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoWriter($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoWriter']) ? (string)$this->existingValues['videoWriter'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoDuration($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoDuration']) ? (string)$this->existingValues['videoDuration'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoReleaseDate($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoReleaseDate']) ? (string)$this->existingValues['videoReleaseDate'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoTag($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoTag']) ? (string)$this->existingValues['videoTag'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadVideoSeries($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['videoSeries']) ? (string)$this->existingValues['videoSeries'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticlePublishedTime($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articlePublishedTime']) ? (string)$this->existingValues['articlePublishedTime'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticleModifiedTime($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articleModifiedTime']) ? (string)$this->existingValues['articleModifiedTime'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticleExpirationTime($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articleExpirationTime']) ? (string)$this->existingValues['articleExpirationTime'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticleAuthor($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articleAuthor']) ? (string)$this->existingValues['articleAuthor'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticleSection($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articleSection']) ? (string)$this->existingValues['articleSection'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadArticleTag($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['articleTag']) ? (string)$this->existingValues['articleTag'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadBookAuthor($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['bookAuthor']) ? (string)$this->existingValues['bookAuthor'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadBookIsbn($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['bookIsbn']) ? (string)$this->existingValues['bookIsbn'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadBookReleaseDate($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['bookReleaseDate']) ? (string)$this->existingValues['bookReleaseDate'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadBookTag($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['bookTag']) ? (string)$this->existingValues['bookTag'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadProfileFirstName($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['profileFirstName']) ? (string)$this->existingValues['profileFirstName'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadProfileLastName($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['profileLastName']) ? (string)$this->existingValues['profileLastName'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadProfileUsername($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['profileUsername']) ? (string)$this->existingValues['profileUsername'] : '';
	}

	/**
	 * @param string $value
	 * @param DC_Table $DC
	 * @return string
	 */
	public function loadProfileGender($value, DC_Table $DC)
	{
		$this->loadExistingValues($DC);

		return isset($this->existingValues['profileGender']) ? (string)$this->existingValues['profileGender'] : '';
	}
}
