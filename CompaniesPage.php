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
		$gridFieldConfig = new GridFieldConfig();
		$gridFieldConfig->addComponent(new GridFieldDefaultColumns());
		$gridFieldConfig->addComponent(new GridFieldSortableHeader());
		$gridFieldConfig->addComponent(new GridFieldPaginator);
		$gridFieldConfig->addComponent(new GridFieldFilter());
		$grid = new GridField('Companies', 'Companies', new DataList('Company'),$gridFieldConfig);
		return new Form($this,'GridForm',new FieldList($grid),new FieldList());
	}
}
