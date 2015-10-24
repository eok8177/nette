<?php
namespace App\FrontModule;

use Nette,
	Nette\Application\UI\Form;


class PostPresenter extends BasePresenter
{
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function renderShow($postId)
	{
		$post = $this->database->table('posts')->get($postId);
		if (!$post) {
			$this->error('Post not found');
		}

		$this->template->post = $post;
		$this->template->comments = $post->related('comments')->order('created_at');
	}

	protected function createComponentCommentForm()
	{
		$form = new Form;

		$form->addText('name', 'Your name:')
			->setRequired();

		$form->addText('email', 'Email:');

		$form->addTextArea('content', 'Comment:')
			->setRequired();

		$form->addSubmit('send', 'Publish comment');

		$form->onSuccess[] = array($this, 'commentFormSucceeded');

		return $form;
	}

	public function commentFormSucceeded($form, $values)
	{
		$postId = $this->getParameter('postId');

		$this->database->table('comments')->insert(array(
			'post_id' => $postId,
			'name' => $values->name,
			'email' => $values->email,
			'content' => $values->content,
		));

		$this->flashMessage('Thank you for your comment', 'success');
		$this->redirect('this');
	}
}