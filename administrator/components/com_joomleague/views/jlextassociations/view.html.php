<?php
/**
 * @copyright	Copyright (C) 2006-2009 JoomLeague.net. All rights reserved.
 * @license		GNU/GPL,see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License,and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

/**
 * HTML View class for the Joomleague component
 *
 * @static
 * @package	JoomLeague
 * @since	1.5.0a
 */
class JoomleagueViewjlextassociations extends JLGView
{
	function display($tpl=null)
	{
		//$option='com_joomleague';
		$mainframe =& JFactory::getApplication();
    $db =& JFactory::getDBO();
		$uri =& JFactory::getURI();
		$document	=& JFactory::getDocument();
    $option = JRequest::getCmd('option');
    $optiontext = strtoupper(JRequest::getCmd('option').'_');
    $this->assignRef( 'optiontext',			$optiontext );
		// Set toolbar items for the page
		JToolBarHelper::title(JText::_('COM_JOOMLEAGUE_ADMIN_ASSOCIATIONS_TITLE'),'generic.png');
// 		JToolBarHelper::addNewX();
// 		JToolBarHelper::editListX();
		JLToolBarHelper::addNew('jlextassociation.add');
		JLToolBarHelper::editList('jlextassociation.edit');
		JToolBarHelper::custom('jlextassociation.import','upload','upload',JText::_('COM_JOOMLEAGUE_GLOBAL_CSV_IMPORT'),false);
		JToolBarHelper::archiveList('jlextassociation.export',JText::_('COM_JOOMLEAGUE_GLOBAL_XML_EXPORT'));
		//JToolBarHelper::deleteList();
		JLToolBarHelper::deleteList('', 'jlextassociation.remove');
		JToolBarHelper::divider();

		JToolBarHelper::help('screen.joomleague',true);

		

		$filter_order		= $mainframe->getUserStateFromRequest($option.'assoc_filter_order',		'filter_order',		'objassoc.ordering',	'cmd');
		$filter_order_Dir	= $mainframe->getUserStateFromRequest($option.'assoc_filter_order_Dir',	'filter_order_Dir',	'',				'word');
		$search				= $mainframe->getUserStateFromRequest($option.'assoc_search',			'search',			'',				'string');
		$search=JString::strtolower($search);

		$items =& $this->get('Data');
		$total =& $this->get('Total');
		$pagination =& $this->get('Pagination');

		// table ordering
		$lists['order_Dir']=$filter_order_Dir;
		$lists['order']=$filter_order;

		// search filter
		$lists['search']=$search;

		$this->assignRef('user',JFactory::getUser());
		$this->assignRef('lists',$lists);
		$this->assignRef('items',$items);
		$this->assignRef('pagination',$pagination);
		$this->assignRef('request_url',$uri->toString());

		parent::display($tpl);
	}

}
?>