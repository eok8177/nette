<?php

namespace App\FrontModule;

use Nette;
use App\Forms\SignFormFactory;


class SignPresenter extends BasePresenter
{
	/** @var SignFormFactory @inject */
	public $factory;


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = array($this, 'signInFormSucceeded');
		return $form;
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('Default:Default');
	}

	public function signInFormSucceeded($form)
	{
		$values = $form->values;

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Default:Default');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError('Incorrect username or password.');
		}
	}

}
