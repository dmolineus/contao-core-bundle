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
 * Load tl_image_size language file
 */
System::loadLanguageFile('tl_image_size');


/**
 * Table tl_image_size_item
 */
$GLOBALS['TL_DCA']['tl_image_size_item'] =
[

	// Config
	'config' =>
	[
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_image_size',
		'enableVersioning'            => true,
		'onload_callback' =>
		[
			['tl_image_size_item', 'checkPermission'],
			['tl_image_size_item', 'showJsLibraryHint']
		],
		'sql' =>
		[
			'keys' =>
			[
				'id' => 'primary',
				'pid' => 'index'
			]
		]
	],

	// List
	'list' =>
	[
		'sorting' =>
		[
			'mode'                    => 4,
			'fields'                  => ['sorting'],
			'panelLayout'             => 'limit',
			'headerFields'            => ['name', 'tstamp', 'width', 'height', 'resizeMode', 'zoom'],
			'child_record_callback'   => ['tl_image_size_item', 'listImageSizeItem'],
			'child_record_class'      => 'no_padding'
		],
		'global_operations' =>
		[
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
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			],
			'copy' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			],
			'cut' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			],
			'delete' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'toggle' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s,\'tl_image_size_item\')"',
				'button_callback'     => ['tl_image_size_item', 'toggleIcon']
			],
			'show' =>
			[
				'label'               => &$GLOBALS['TL_LANG']['tl_image_size_item']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			]
		]
	],

	// Palettes
	'palettes' =>
	[
		'default'                     => '{title_legend},media,width,height,resizeMode,zoom;{expert_legend},sizes,densities;{visibility_legend},invisible',
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
			'foreignKey'              => 'tl_image_size.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => ['type'=>'belongsTo', 'load'=>'lazy']
		],
		'sorting' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'tstamp' =>
		[
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		],
		'media' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size_item']['media'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => ['mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long', 'decodeEntities'=>true],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'sizes' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['sizes'],
			'inputType'               => 'text',
			'explanation'             => 'imageSizeDensities',
			'exclude'                 => true,
			'eval'                    => ['helpwizard'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'decodeEntities'=>true],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'densities' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['densities'],
			'inputType'               => 'text',
			'explanation'             => 'imageSizeDensities',
			'exclude'                 => true,
			'eval'                    => ['helpwizard'=>true, 'maxlength'=>255, 'tl_class'=>'w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'width' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['width'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => ['rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'clr w50'],
			'sql'                     => "int(10) NULL"
		],
		'height' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['height'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => ['rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'],
			'sql'                     => "int(10) NULL"
		],
		'resizeMode' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['resizeMode'],
			'inputType'               => 'select',
			'options'                 => ['proportional', 'box', 'crop'],
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'exclude'                 => true,
			'eval'                    => ['helpwizard'=>true, 'tl_class'=>'clr w50'],
			'sql'                     => "varchar(255) NOT NULL default ''"
		],
		'zoom' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size']['zoom'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'eval'                    => ['rgxp'=>'prcnt', 'nospace'=>true, 'tl_class'=>'w50'],
			'sql'                     => "int(10) NULL"
		],
		'invisible' =>
		[
			'label'                   => &$GLOBALS['TL_LANG']['tl_image_size_item']['invisible'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		]
	]
];


/**
 * Class tl_image_size_item
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    Core
 */
class tl_image_size_item extends Backend
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

		if (!$this->User->hasAccess('image_sizes', 'themes'))
		{
			$this->log('Not enough permissions to access the image sizes module', __METHOD__, TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}
	}


	/**
	 * List an image size item
	 * @param array
	 * @return string
	 */
	public function listImageSizeItem($row)
	{
		$html = '<div class="tl_content_left">';
		$html .= $row['media'];

		if ($row['width'] || $row['height'])
		{
			$html .= ' <span style="padding-left:3px">' . $row['width'] . 'x' . $row['height'] . '</span>';
		}

		if ($row['zoom'])
		{
			$html .= ' <span style="color:#b3b3b3;padding-left:3px">(' . $row['zoom'] . '%)</span>';
		}

		$html .= "</div>\n";

		return $html;
	}


	/**
	 * Show a hint if a JavaScript library needs to be included in the page layout
	 */
	public function showJsLibraryHint()
	{
		if ($_POST || Input::get('act') != 'edit')
		{
			return;
		}

		// Return if the user cannot access the layout module (see #6190)
		if (!$this->User->hasAccess('themes', 'modules') || !$this->User->hasAccess('layout', 'themes'))
		{
			return;
		}

		System::loadLanguageFile('tl_layout');
		Message::addInfo(sprintf($GLOBALS['TL_LANG']['tl_image_size']['picturefill'], 'picturefill.js', 'respimage.js'));
	}


	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.$row['invisible'];

		if ($row['invisible'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}


	/**
	 * Toggle the visibility of a format definition
	 * @param integer
	 * @param boolean
	 * @param Contao\DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, Contao\DataContainer $dc=null)
	{
		$objVersions = new Versions('tl_image_size_item', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_image_size_item']['fields']['invisible']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_image_size_item']['fields']['invisible']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_image_size_item SET tstamp=". time() .", invisible='" . ($blnVisible ? '' : 1) . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_image_size_item.id='.$intId.'" has been created'.$this->getParentEntries('tl_image_size_item', $intId), __METHOD__, TL_GENERAL);
	}
}
