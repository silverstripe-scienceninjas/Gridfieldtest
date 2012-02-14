<?php
/**
 * Main CompaniesPage
 *
 */
class CompaniesPage extends Page {
	
	public function requireDefaultRecords() {
		parent::requireDefaultRecords();
		$page = DataObject::get_one('CompaniesPage');
		if(!$page) { $page = new CompaniesPage(); }
		$page->URLSegment = 'forbes-500';
		$page->Title = 'Forbes 500';
		$page->ParentID = 0;
		$page->write();
		$page->doPublish();
	}
}