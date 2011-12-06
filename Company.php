<?php

class Company extends DataObject {

	/**
	 *
	 * @var array
	 */
	public static $db = array(
		'Name'=>'Varchar(255)',
		'URL'=>'Varchar(255)',
		'Otherfield'=>'Varchar(255)',
	);

	public static $summary_fields = array('Name', 'URL', 'Otherfield');

	public function requireDefaultRecords() {
		parent::requireDefaultRecords();
		$companies = $this->data();
		$companySet = DataObject::get('Company');

		if (!$companySet->count()) {
			foreach ($companies as $company) {
				$docompany = new Company(array(
							'Name'=>$company,
							'URL'=>sha1($company.microtime(true)),
							'Otherfield'=>sha1(microtime(true))
						));
				$docompany->write();
			}
		} else {
			foreach ($companySet as $company) {
				$company->URL = sha1($company);
				$company->Otherfield = sha1($company);
				$company->write();
			}
		}
	}

	/**
	 * Contains some test names for fakeobjects
	 *
	 * @return array
	 */
	public function data() {
		return array(
			'Hayley', 'Octavius', 'Walker', 'Gary','Elton','Janna','Ursa','Lars','Moses','Lareina',
			'Elmo','Cara','Shea','Duncan','Velma','Acton','Galena','Heidi','Troy','Elliott','Cara',
			'Whitney','Summer','Olga','Tatum','Zeph','Jared','Hilda','Quinlan','Chaim','Xenos',
			'Cara','Tatiana','Tyrone','Juliet','Chester','Hannah','Imani','Quinn','Ariel','Abel',
			'Aretha','Courtney ','Shellie','Garrett','Camilla','Simon','Mohammad','Kirby','Rae',
			'Xena','Noel','Omar','Shannon','Iola','Maia','Serina','Taylor','Alice','Lucy','Austin',
			'Abel','Quinn','Yetta','Ulysses','Donovan','Castor','Emmanuel','Nero','Virginia',
			'Gregory','Neville','Abel','Len','Knox','Gavin','Pascale','Hyatt','Alden','Emerald',
			'Cherokee','Zeph','Adam','Uma','Serena','Isabelle','Kieran','Moses','Gay','Lavinia',
			'Elvis','Illana','Lee','Ariana','Hilel','Juliet','Gage','Larissa','Richard','Allen'
		);
	}

}
