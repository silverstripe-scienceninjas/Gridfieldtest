<?php
/**
 * Main CompaniesPage
 *
 */
class CompaniesPage extends Page {
	
	public function requireDefaultRecords() {
		parent::requireDefaultRecords();
		$page = DataObject::get_one('CompaniesPage');
		
		if(!$page) {
			$page = new CompaniesPage();
		}
		
		$page->URLSegment = 'companies';
		$page->Title = 'Companies';
		$page->ParentID = 0;
		$page->write();
		$page->doPublish();
	}
}

/**
 * Controller for CompaniesPage
 */
class CompaniesPage_Controller extends Page_Controller {
	
	/**
	 *
	 * @var string
	 */
	public $Title = "Companies";
	
	public function init(){
		parent::init();
		Requirements::javascript(SAPPHIRE_DIR.'/thirdparty/jquery/jquery.js');
		Requirements::css('gridfieldtest/css/gridfieldtest.css','screen');
	}
	
	/**
	 *
	 * @return Form 
	 */
	public function GridForm(){
		$config = new GridFieldConfig();
		$config->addComponent(new GridFieldDefaultColumns());
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldPaginator);
		$config->addComponent(new GridFieldFilter());
		$config->addComponent(new GridFieldAction_Delete());
		
		$config->addComponent(new CompaniesPage_ViewAction());
		$config->addComponent(new GridFieldPopupForms($this, 'GridForm'));
		
		$grid = new GridField('Companies', 'Companies', new DataList('Company'),$config);
		return new Form($this,'GridForm',new FieldList($grid),new FieldList());
	}
}

/**
 * This class is an GridField Component that add Delete action for Objects in the GridField
 * 
 */
class CompaniesPage_ViewAction implements GridField_ColumnProvider {
	
	/**
	 * Add a column 'Delete'
	 * 
	 * @param type $gridField
	 * @param array $columns 
	 */
	public function augmentColumns($gridField, &$columns) {
		$columns[] = 'EditAction';
	}
	
	/**
	 * Return any special attributes that will be used for FormField::createTag()
	 *
	 * @param GridField $gridField
	 * @param DataObject $record
	 * @param string $columnName
	 * @return array
	 */
	public function getColumnAttributes($gridField, $record, $columnName) {
		return array();
	}
	
	/**
	 * Add the title 
	 * 
	 * @param GridField $gridField
	 * @param string $columnName
	 * @return array
	 */
	public function getColumnMetadata($gridField, $columnName) {
		if($columnName == 'EditAction') {
			return array('title' => 'Edit');
		}
	}
	
	/**
	 * Which columns are handled by this component
	 * 
	 * @param type $gridField
	 * @return type 
	 */
	public function getColumnsHandled($gridField) {
		return array('EditAction');
	}
	
	/**
	 *
	 * @param GridField $gridField
	 * @param DataObject $record
	 * @param string $columnName
	 * @return string - the HTML for the column 
	 */
	public function getColumnContent($gridField, $record, $columnName) {
		return sprintf('<a class="action-edit" href="%s">%s</a>', Controller::join_links($gridField->Link('item'), $record->ID, 'edit'), _t('CompanyPage.Edit', 'Edit'));
	}
}