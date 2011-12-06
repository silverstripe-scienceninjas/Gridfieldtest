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
	
	/**
	 *
	 * @return Form 
	 */
	public function Companies(){
		GridFieldPresenter::add_extension('GridFieldPaginator_Extension');
		$presenter = new GridFieldPresenter();
		$presenter->paginationLimit(20);
		$grid = new GridField('Companies', 'Companies', new DataList('Company'), null, $presenter);
		$grid->setDefaultState('Sort', array('Name' => 'desc','Otherfield' => 'asc'));
		$grid->setDefaultState('Page', 3);
		
		return new Form($this, 'Companies', new FieldList($grid), new FieldList(new FormAction('reload', 'Reload')));
	}

	/**
	 *
	 * @param type $data
	 * @param type $form
	 * @return type 
	 */
	public function reload($data, $form) {
		if($this->isAjax()){
			return $form->forTemplate();
		}
		return $this->render(array('Companies'=>$form));
	}
}
