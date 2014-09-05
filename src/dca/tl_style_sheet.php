<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Core
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_style_sheet
 */
$GLOBALS['TL_DCA']['tl_style_sheet'] =
[

	// Config
	'config' =>
	[
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_theme',
		'ctable'                      => ['tl_style'],
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'onload_callback' =>
		[
			['tl_style_sheet', 'checkPermission'],
			['tl_style_sheet', 'updateStyleSheet']
		],
		'oncopy_callback' =>
		[
			['tl_style_sheet', 'scheduleUpdate']
		],
		'onsubmit_callback' =>
		[
			['tl_style_sheet', 'scheduleUpdate']
		],
		'sql' =>
		[
			'keys' =>
			[
				'id' => 'primary',
				'name' => 'unique'
			]
		]
	],

	// List
	'list' =>
	[
		'sorting' =>
		[
			'mode'                    => 4,
			'fields'                  => ['name'],
			'panelLayout'             => 'filter;search,limit',
			'headerFields'            => ['name', 'author', 'tstamp'],
			'child_record_callback'   => ['tl_style_sheet', 'listStyleSheet'],
			'child_record_class'      => 'no_padding'
		],
		'global_operations' =>
		[
			'import' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['import'],
				'href'                => 'key=import',
				'class'               => 'header_css_import',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			],
			'all' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			]
		],
		'operations' =>
		[
			'edit' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['edit'],
				'href'                => 'table=tl_style',
				'icon'                => 'edit.gif'
			],
			'editheader' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['editheader'],
				'href'                => 'table=tl_style_sheet&amp;act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => ['tl_style_sheet', 'editHeader']
			],
			'copy' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			],
			'cut' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			],
			'delete' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'show' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_style_sheet']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			]
		]
	],

	// Palettes
	'palettes' =>
	[
		'default'                     => '{title_legend},name;{media_legend},media,mediaQuery;{vars_legend},vars;{expert_legend:hide},embedImages,cc'
	],

	// Fields
	'fields' =>
	[
		'id' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		],
		'pid' =>
		[
			'foreignKey'              => 'tl_theme.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => ['type'=>'belongsTo', 'load'=>'lazy']
		],
		'tstamp' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'name' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['name'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'flag'                    => 1,
			'eval'                    => ['mandatory'=>true, 'unique'=>true, 'rgxp'=>'alnum', 'maxlength'=>64, 'spaceToUnderscore'=>true],
			'sql'                     => "varchar(64) NULL"
		],
		'embedImages' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['embedImages'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => ['rgxp'=>'digit', 'tl_class'=>'w50'],
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'cc' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['cc'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'search'                  => true,
			'eval'                    => ['decodeEntities'=>true, 'tl_class'=>'w50'],
			'save_callback' =>
			[
				['tl_style_sheet', 'sanitizeCc']
			],
			'sql'                     => "varchar(32) NOT NULL default ''"
		],
		'media' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['media'],
			'default'                 => ['all'],
			'inputType'               => 'checkbox',
			'exclude'                 => true,
			'filter'                  => true,
			'options'                 => ['all', 'aural', 'braille', 'embossed', 'handheld', 'print', 'projection', 'screen', 'tty', 'tv'],
			'eval'                    => ['multiple'=>true, 'mandatory'=>true, 'tl_class'=>'clr'],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'mediaQuery' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['mediaQuery'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => true,
			'eval'                    => ['decodeEntities'=>true, 'style'=>'height:60px'],
			'sql'                     => "text NULL"
		],
		'vars' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_style_sheet']['vars'],
			'inputType'               => 'keyValueWizard',
			'exclude'                 => true,
			'sql'                     => "text NULL"
		]
	]
];


/**
 * Class tl_style_sheet
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */
class tl_style_sheet extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Check permissions to edit the table
	 */
	public function checkPermission()
	{
		if ($this->User->isAdmin)
		{
			return;
		}

		if (!$this->User->hasAccess('css', 'themes'))
		{
			$this->log('Not enough permissions to access the style sheets module', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
	}


	/**
	 * Check for modified style sheets and update them if necessary
	 */
	public function updateStyleSheet()
	{
		$session = $this->Session->get('style_sheet_updater');

		if (!is_array($session) || empty($session))
		{
			return;
		}

		$this->import('StyleSheets');

		foreach ($session as $id)
		{
			$this->StyleSheets->updateStyleSheet($id);
		}

		$this->Session->set('style_sheet_updater', null);
	}


	/**
	 * Schedule a style sheet update
	 *
	 * This method is triggered when a single style sheet or multiple style
	 * sheets are modified (edit/editAll) or duplicated (copy/copyAll).
	 * @param mixed
	 */
	public function scheduleUpdate($id)
	{
		// The onsubmit_callback passes a DataContainer object
		if (is_object($id))
		{
			$id = $id->id;
		}

		// Return if there is no ID
		if (!$id || Input::get('act') == 'copy')
		{
			return;
		}

		// Store the ID in the session
		$session = $this->Session->get('style_sheet_updater');
		$session[] = $id;
		$this->Session->set('style_sheet_updater', array_unique($session));
	}


	/**
	 * List a style sheet
	 * @param array
	 * @return string
	 */
	public function listStyleSheet($row)
	{
		$cc = '';
		$media = deserialize($row['media']);

		if ($row['cc'] != '')
		{
			$cc = ' &lt;!--['. $row['cc'] .']&gt;';
		}

		if ($row['mediaQuery'] != '')
		{
			return '<div class="tl_content_left">'. $row['name'] .' <span style="color:#b3b3b3;padding-left:3px">@media '. $row['mediaQuery'] . $cc .'</span>' . "</div>\n";
		}
		elseif (!empty($media) && is_array($media))
		{
			return '<div class="tl_content_left">'. $row['name'] .' <span style="color:#b3b3b3;padding-left:3px">@media '. implode(', ', $media) . $cc .'</span>' . "</div>\n";
		}
		else
		{
			return '<div class="tl_content_left">'. $row['name'] . $cc ."</div>\n";
		}
	}


	/**
	 * Sanitize the conditional comments field
	 * @param mixed
	 * @return mixed
	 */
	public function sanitizeCc($varValue)
	{
		if ($varValue != '')
		{
			$varValue = str_replace(['<!--[', ']>'], '', $varValue);
		}

		return $varValue;
	}


	/**
	 * Return the edit header button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return $this->User->canEditFieldsOf('tl_style_sheet') ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ' : Image::getHtml(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
}