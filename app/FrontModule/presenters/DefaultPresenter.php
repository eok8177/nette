<?php

namespace App\FrontModule;

use Nette;
use App\Model;


class DefaultPresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
