<?php

namespace Anker\OpenGraphBundle;

use Contao\Idna;
use Contao\PageModel;
use Contao\Controller;
use Contao\FilesModel;
use Contao\Environment;
use Contao\LayoutModel;
use Contao\PageRegular;

class HookController extends Controller
{

	/**
	 * @param PageModel $objPage
	 * @param LayoutModel $objLayout
	 * @param PageRegular $objPageRegular
	 * @return void
	 */
	public function addHeadDataAction(PageModel $objPage, LayoutModel $objLayout, PageRegular $objPageRegular)
	{
		$ogTags = [];
		$ogTags['og:url'] = Idna::decode(Environment::get('base')).Environment::get('indexFreeRequest');
		$ogTags['twitter:card'] = 'summary';
		$ogTags['og:type'] = isset($objPage->ogType) && $objPage->ogType != '' ? $objPage->ogType : '';

		$ogTagData = isset($objPage->ogTags) && $objPage->ogTags != '' ? unserialize($objPage->ogTags) : [];
		if (count($ogTagData) > 0) {
			$tagMapping = include __DIR__.'/../config/tag_mapping.php';
			foreach ($ogTagData as $index => $ogTagDate) {
				if (isset($tagMapping[$index])) {
					$index = $tagMapping[$index];
				}
				$ogTags[$index] = $ogTagDate;
			}
		}

		if (!(isset($objPage->ogTitle) && $objPage->ogTitle != '')) {
			$ogTags['og:title'] = $objPage->pageTitle ?: $objPage->title;
		}

		if (!(isset($objPage->ogDescription) && $objPage->ogDescription != '')) {
			$ogTags['og:description'] = $objPage->description ?: '';
		}

		$ogTags['twitter:title'] = $ogTags['og:title'];
		$ogTags['twitter:description'] = $ogTags['og:description'];

		if (isset($objPage->ogImage) && $objPage->ogImage != '') {
			$fileInfo = $this->getFileInfo($objPage->ogImage, true);
			if (isset($fileInfo['url'])) {
				$ogTags['og:image'] = $fileInfo['url'];
				$ogTags['twitter:image'] = $fileInfo['url'];
			}
			if (isset($fileInfo['mime_type'])) {
				$ogTags['og:image:type'] = $fileInfo['mime_type'];
				$ogTags['twitter:image:type'] = $fileInfo['mime_type'];
			}
			if (isset($fileInfo['width'])) {
				$ogTags['og:image:width'] = $fileInfo['width'];
				$ogTags['twitter:image:width'] = $fileInfo['width'];
			}
			if (isset($fileInfo['height'])) {
				$ogTags['og:image:height'] = $fileInfo['height'];
				$ogTags['twitter:image:height'] = $fileInfo['height'];
			}
		}

		if (isset($objPage->ogAudio) && $objPage->ogAudio != '') {
			$fileInfo = $this->getFileInfo($objPage->ogAudio);
			if (isset($fileInfo['url'])) {
				$ogTags['og:audio'] = $fileInfo['url'];
			}
			if (isset($fileInfo['mime_type'])) {
				$ogTags['og:audio:type'] = $fileInfo['mime_type'];
			}
		}

		if (isset($objPage->ogVideo) && $objPage->ogVideo != '') {
			$fileInfo = $this->getFileInfo($objPage->ogVideo);
			if (isset($fileInfo['url'])) {
				$ogTags['og:video'] = $fileInfo['url'];
			}
			if (isset($fileInfo['mime_type'])) {
				$ogTags['og:video:type'] = $fileInfo['mime_type'];
			}
		}

		foreach ($ogTags as $property => $content) {
			if ($content != '') {
				if (!isset($GLOBALS['TL_HEAD']['og_tags_'.$property])) {
					$GLOBALS['TL_HEAD']['og_tags_'.$property] = '<meta property="'.$property.'" content="'.str_replace("\n", ' ', $content).'" />';
				}
			}
		}
	}

	/**
	 * @param string $filePk
	 * @param bool $isImage
	 * @return array
	 */
	protected function getFileInfo($filePk, $isImage = false)
	{
		$fileInfo = [];

		$objFile = FilesModel::findByPk($filePk);
		$ogImage = $objFile ? (string)$objFile->path : '';
		if ($ogImage != '') {
			$baseUrl = Idna::decode(Environment::get('base'));
			if ($baseUrl == '') {
				$baseUrl = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, -9);
			}
			$fileInfo['url'] = $baseUrl.$ogImage;

			if (file_exists(TL_ROOT.TL_FILES_URL.'/'.$ogImage)) {
				$image = TL_ROOT.TL_FILES_URL.'/'.$ogImage;
			} elseif (file_exists(TL_ROOT.'/'.$ogImage)) {
				$image = TL_ROOT.'/'.$ogImage;
			} else {
				$image = dirname(__FILE__).'/../../../../../'.$ogImage;
			}

			$mimeType = @mime_content_type($image);
			if ($mimeType) {
				$fileInfo['mime_type'] = $mimeType;
			}

			if ($isImage) {
				$imagesize = @getimagesize($image);
				if ($imagesize) {
					$fileInfo['width'] = $imagesize[0];
					$fileInfo['height'] = $imagesize[1];
				}
			}
		}

		return $fileInfo;
	}
}
