<?php
/**
 * Controller for CompaniesPage
 */
class CompaniesPage_Controller extends Page_Controller {

	/**
	 *
	 * @var array
	 */
	public static $allowed_actions = array ('index', 'GridForm');

	public function init() {
		Requirements::css('gridfieldtest/css/gridfieldtest.css', 'screen');
		Requirements::javascript(SAPPHIRE_DIR.'/thirdparty/jquery/jquery.js');
		parent::init();
	}
	
	public function GridForm(){
		#$grid = $this->getDefaultGrid(new DataList('Company'));
		
		#$grid = $this->getMiniGrid(new DataList('Company'));
		#$grid = $this->getPaginatedGrid(new DataList('Company'));
		#$grid = $this->getFilterableGrid(new DataList('Company'));
		#$grid = $this->getPresortedGrid(new DataList('Company'));
		

		$grid = $this->getGridWithActions(new DataList('Company'));

		return new Form($this, 'GridForm', new FieldList($grid), new FieldList());
	}

	protected function getDefaultGrid(SS_List $list) {
		return new GridField('Companies', 'Companies', $list);
	}

	protected function getMiniGrid(SS_List $list) {
		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldDefaultColumns());
		return new GridField('Companies', 'Companies', $list, $config);
	}

	protected function getPaginatedGrid(SS_List $list) {
		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldDefaultColumns());
		$config->addComponent(new GridFieldPaginator(10));
		return new GridField('Companies', 'Companies', $list, $config);
	}

	protected function getFilterableGrid(SS_List $list) {
		$config = GridFieldConfig::create();
		$config->addComponent(new GridFieldSortableHeader());
		$config->addComponent(new GridFieldDefaultColumns());
		$config->addComponent(new GridFieldPaginator(10));
		$config->addComponent(new GridFieldFilter());
		return new GridField('Companies', 'Companies', $list, $config);
	}

	protected function getPresortedGrid(SS_List $list) {
		$gridField = new GridField('Companies', 'Companies', $list);
		$gridField->State->GridFieldSortableHeader->SortColumn = 'Name';
		$gridField->State->GridFieldSortableHeader->SortDirection = 'asc';
		return $gridField;
	}

	protected function getGridWithActions(SS_List $list) {
		$config = new GridFieldConfig_Base();
		$config->addComponent(new GridFieldAction_Delete());
		$config->addComponent(new GridFieldAction_Edit());
		$config->addComponent(new GridFieldPopupForms($this, 'GridForm'));
		return new GridField('Companies', 'Companies', $list, $config);
	}

}