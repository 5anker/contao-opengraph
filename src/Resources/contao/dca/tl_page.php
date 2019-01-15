<?php

$GLOBALS['TL_DCA']['tl_page']['config']['onsubmit_callback'][] = ['Anker\OpenGraphBundle\OgTagsDcaCallback', 'saveOgTags'];
//$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'ogTagsEnable';
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'ogType';
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace('description;', 'description;{og_tags_legend:hide},ogTitle,ogType,ogImage,ogDescription,ogAudio,ogVideo,ogDeterminer,ogLocale,ogLocaleAlternate;', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);

$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_music.song'] = 'musicDuration,musicAlbum,musicAlbumDisc,musicAlbumTrack,musicAlbumMusician';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_music.album'] = 'musicAlbumMusician,musicReleaseDate';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_music.playlist'] = 'musicCreator';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_music.radio_station'] = 'musicCreator';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_video.movie'] = 'videoActor,videoActorRole,videoDirector,videoWriter,videoDuration,videoReleaseDate,videoTag';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_video.episode'] = 'videoActor,videoActorRole,videoDirector,videoWriter,videoDuration,videoReleaseDate,videoTag,videoSeries';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_video.tv_show'] = 'videoActor,videoActorRole,videoDirector,videoWriter,videoDuration,videoReleaseDate,videoTag';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_video.other'] = 'videoActor,videoActorRole,videoDirector,videoWriter,videoDuration,videoReleaseDate,videoTag';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_article'] = 'articlePublishedTime,articleModifiedTime,articleExpirationTime,articleAuthor,articleSection,articleTag';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_book'] = 'bookAuthor,bookIsbn,bookReleaseDate,bookTag';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ogType_profile'] = 'profileFirstName,profileLastName,profileUsername,profileGender';

// $GLOBALS['TL_DCA']['tl_page']['fields']['ogTagsEnable'] = [
// 		'label' => &$GLOBALS['TL_LANG']['tl_page']['ogTagsEnable'],
// 		'inputType' => 'checkbox',
// 		'eval' => [
// 			'tl_class' => 'w50 m12',
// 			'submitOnChange' => true,
// 		],
// 		'sql' => "char(1) NOT NULL default ''",
// ];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogTags'] = [
	'sql' => "longtext NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogTitle'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogTitle'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadTitle'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogType'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogType'],
	'exclude' => true,
	'inputType' => 'select',
	'default' => 'website',
	'options' => [
		'website' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['website'],
		'article' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['article'],
		'book' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['book'],
		'profile' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['profile'],
		'music' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['music'],
		'music.song' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['music.song'],
		'music.album' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['music.album'],
		'music.playlist' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['music.playlist'],
		'music.radio_station' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['music.radio_station'],
		'video' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['video'],
		'video.movie' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['video.movie'],
		'video.episode' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['video.episode'],
		'video.tv_show' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['video.tv_show'],
		'video.other' => $GLOBALS['TL_LANG']['tl_page']['og_tags_type_options']['video.other'],
	],
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'submitOnChange' => true,
	],
	'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogImage'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogImage'],
	'exclude' => true,
	'inputType' => 'fileTree',
	'eval' => [
		'fieldType' => 'radio',
		'maxlength' => 255,
		'filesOnly' => true,
		'tl_class' => 'clr  wizard',
	],
	'sql' => "binary(16) NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogDescription'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogDescription'],
	'exclude' => true,
	'inputType' => 'textarea',
	'search' => true,
	'eval' => [
		'style' => 'height:60px',
		'tl_class' => 'clr',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadDescription'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogAudio'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogAudio'],
	'exclude' => true,
	'inputType' => 'fileTree',
	'eval' => [
		'fieldType' => 'radio',
		'maxlength' => 255,
		'filesOnly' => true,
		'tl_class' => 'clr  wizard',
	],
	'sql' => "binary(16) NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogVideo'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogVideo'],
	'exclude' => true,
	'inputType' => 'fileTree',
	'eval' => [
		'fieldType' => 'radio',
		'maxlength' => 255,
		'filesOnly' => true,
		'tl_class' => 'clr  wizard',
	],
	'sql' => "binary(16) NULL",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogDeterminer'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogDeterminer'],
	'exclude' => true,
	'inputType' => 'select',
	'options' => [
		'',
		'a',
		'an',
		'the',
		'auto',
	],
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadDeterminer'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogLocale'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogLocale'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadLocale'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['ogLocaleAlternate'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['ogLocaleAlternate'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadLocaleAlternate'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicDuration'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicDuration'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicDuration'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicAlbum'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicAlbum'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicAlbum'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicAlbumDisc'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicAlbumDisc'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicAlbumDisc'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicAlbumTrack'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicAlbumTrack'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicAlbumTrack'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicAlbumMusician'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicAlbumMusician'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicAlbumMusician'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicReleaseDate'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicReleaseDate'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'date',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicReleaseDate'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['musicCreator'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['musicCreator'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadMusicCreator'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoActor'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoActor'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoActor'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoActorRole'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoActorRole'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoActorRole'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoDirector'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoDirector'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoDirector'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoWriter'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoWriter'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoWriter'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoDuration'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoDuration'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoDuration'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoReleaseDate'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoReleaseDate'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'date',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoReleaseDate'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoTag'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoTag'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoTag'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['videoSeries'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['videoSeries'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadVideoSeries'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articlePublishedTime'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articlePublishedTime'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'datim',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticlePublishedTime'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articleModifiedTime'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articleModifiedTime'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'datim',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticleModifiedTime'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articleExpirationTime'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articleExpirationTime'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'datim',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticleExpirationTime'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articleAuthor'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articleAuthor'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticleAuthor'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articleSection'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articleSection'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticleSection'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['articleTag'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['articleTag'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadArticleTag'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['bookAuthor'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['bookAuthor'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadBookAuthor'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['bookIsbn'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['bookIsbn'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadBookIsbn'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['bookReleaseDate'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['bookReleaseDate'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
		'rgxp'=>'datim',
		'datepicker' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadBookReleaseDate'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['bookTag'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['bookTag'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadBookTag'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['profileFirstName'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['profileFirstName'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadProfileFirstName'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['profileLastName'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['profileLastName'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadProfileLastName'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['profileUsername'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['profileUsername'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => [
		'maxlength' => 255,
		'tl_class' => 'clr w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadProfileUsername'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['profileGender'] = [
	'label' => &$GLOBALS['TL_LANG']['tl_page']['profileGender'],
	'exclude' => true,
	'inputType' => 'select',
	'options' => [
		'' => '',
		'female' => $GLOBALS['TL_LANG']['tl_page']['og_tags_gender']['female'],
		'male' => $GLOBALS['TL_LANG']['tl_page']['og_tags_gender']['male'],
	],
	'eval' => [
		'tl_class' => 'w50',
		'doNotSaveEmpty' => true,
	],
	'load_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'loadProfileGender'],
	],
	'save_callback' => [
		['Anker\OpenGraphBundle\OgTagsDcaCallback', 'pretendSavingField']
	],
];
