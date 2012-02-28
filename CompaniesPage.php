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

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$config = new GridFieldConfig();
		$config->addComponent(new GridFieldDefaultColumns());
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldPaginator);
		$config->addComponent(new GridFieldFilter());
		$config->addComponent(new GridFieldAction_Delete());
		$config->addComponent(new GridFieldAction_Edit());
		$config->addComponent($forms = new GridFieldPopupForms());
		
		$grid = new GridField('Companies', 'Companies', new DataList('Company'),$config);

		$fields->addFieldToTab('Root.Main', $grid);

		return $fields;
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