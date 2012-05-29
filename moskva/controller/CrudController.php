<?php
abstract class CrudController extends BaseController {
	private function renderDefaultView($view, $vars) {
		$template = new Template($view, $vars, Moskva::getInstance()->getMoskvaViewsPath(), 'crud');
		$layoutTemplate = new Template($this->getLayoutName(), array(), Moskva::getInstance()->getViewsPath());

		$template->setParentLayout($layoutTemplate);

		echo $template->render();

	}

	protected function renderCustomThenDefault($view, $vars) {
		try {
			$this->renderView($view, $vars);
		} catch (MoskvaNotFoundViewException $e) {
			$this->renderDefaultView($view, $vars);
		}
	}

	protected function getModelClassName() {
		return $this->getControllerName();
	}

	protected function getFormClassName() {
		return $this->getControllerName() . 'Form';
	}

	/**
	 * @param $entity
	 * @return mModelForm
	 */
	protected function buildForm($entity) {
		$formClassName = $this->getFormClassName();
		return new $formClassName($entity);
	}

	protected function getRepository() {
		return $this->getEntityManager()->getRepository($this->getModelClassName());
	}

	protected function loadEntities() {
		return $this->getRepository()->findAll();
	}

	protected function loadEntity($id) {
		return $this->getRepository()->find($id);
	}

	protected function buildNewEntity() {
		$class = $this->getModelClassName();

		return new $class();
	}

	public function indexAction() {
		$data = $this->loadEntities();
		$this->renderCustomThenDefault('index', array('data' => $data, 'fields' => $this->getGridColumns()));
	}

	protected function deleteEntity($id) {
		$this->getEntityManager()->remove($this->loadEntity($id));
		$this->getEntityManager()->flush();
	}

	protected function processEntityFormRequest($entity) {
		$form = $this->buildForm($entity);

		if ($this->isPostRequest()) {
			$form->loadDataFromRequest();
			if ($form->validate()) {
				$form->updateModel();
				$this->getEntityManager()->persist($entity);
				$this->getEntityManager()->flush($entity);
				$this->redirect(array('update', array('id' => $entity->getId())));
			}
		}

		return $form;
	}

	public function updateAction($id) {
		$entity = $this->loadEntity($id);

		$form = $this->processEntityFormRequest($entity);

		$this->renderCustomThenDefault('update', array('form' => $form, 'entity' => $entity));
	}

	public function createAction() {
		$entity = $this->buildNewEntity();

		$form = $this->processEntityFormRequest($entity);

		$this->renderCustomThenDefault('update', array('form' => $form, 'entity' => $entity));
	}

	public function deleteAction($id) {
		if (!$this->isPostRequest()) {
			throw new MoskvaHttpException(403, 'only POST');
		}

		$this->deleteEntity($id);

		$this->redirect(array('index'));
	}

	public function getGridColumns() {
		return array('id' => 'Id');
	}

	protected function getLayoutName() {
		return 'master';
	}
}