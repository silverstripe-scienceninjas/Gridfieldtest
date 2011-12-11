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
		$grid = new GridField('Companies', 'Companies', new DataList('Company'), null);

		$state = $grid->getState();

		$state->Pagination->Page = 3;
		$state->Pagination->ItemsPerPage = 20;
		$state->Sorting->Order = new stdClass();
		$state->Sorting->Order->Name = 'desc';
		$state->Sorting->Order->Otherfield = 'desc';

		return new GridFieldForm(
			$this,
			'Companies',
			new FieldList(
				$grid,
				new TextField('ExampleTwo', 'Example Two')
			),
			new FieldList(new FormAction('reload', 'Reload'))
		);
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
