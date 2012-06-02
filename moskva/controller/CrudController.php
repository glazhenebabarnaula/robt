<?php
abstract class CrudController extends BaseController {
	public function before() {
		$this->setVar('entity_name', $this->getEntityName());
	}

	protected function buildDefaultTemplateCollection() {
		return new TemplateCollection(Moskva::getInstance()->getInstance()->getMoskvaViewsPath(), 'crud');
	}

	protected function buildTemplateCollection() {
		$templateCollection = parent::buildTemplateCollection();
		$templateCollection->setNextResponsibleTemplatesCollection($this->buildDefaultTemplateCollection());
		$templateCollection->setParentLayout($this->getLayoutName());

		return $templateCollection;
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
		$this->renderView('index', array('data' => $data, 'fields' => $this->getGridColumns()));
	}

	protected function deleteEntity($id) {
		$this->getEntityManager()->remove($this->loadEntity($id));
		$this->getEntityManager()->flush();
	}

	protected function afterFormSave($entity) {
		$this->redirect(array('update', array('id' => $entity->getId())));
	}

	protected function beforeFormSave($entity, $form) {
		$form->updateModel();
	}

	protected function processEntityFormRequest($entity) {
		$form = $this->buildForm($entity);

		if ($this->isPostRequest()) {
			$form->loadDataFromRequest();
			if ($form->validate()) {
				$this->beforeFormSave($entity, $form);
				$this->getEntityManager()->persist($entity);
				$this->getEntityManager()->flush();
				$this->afterFormSave($entity);
			}
		}

		return $form;
	}

	public function updateAction($id) {
		$entity = $this->loadEntity($id);

		$form = $this->processEntityFormRequest($entity);

		$this->renderView('update', array('form' => $form, 'entity' => $entity));
	}

	public function createAction() {
		$entity = $this->buildNewEntity();

		$form = $this->processEntityFormRequest($entity);

		$this->renderView('create', array('form' => $form, 'entity' => $entity));
	}

	protected function beforeDelete($entity) {

	}

	protected function afterDelete($entity) {
		$this->redirect(array('index'));
	}

	public function deleteAction($id) {
		if (!$this->isPostRequest()) {
			//TODO: сделать POST
			//throw new MoskvaHttpException(403, 'only POST');
		}

		$entity = $this->loadEntity($id);

		$this->beforeDelete($entity);

		$this->deleteEntity($id);

		$this->afterDelete($entity);
	}

	public function getGridColumns() {
		return array('id' => 'Id');
	}

	protected function getLayoutName() {
		return 'master';
	}

	protected function getEntityName() {
		return '';
	}

	protected function getAuthenticatedOnlyActions()
	{
		return array('*');
	}

	protected function getAdminOnlyActions()
	{
		return array('*');
	}
}