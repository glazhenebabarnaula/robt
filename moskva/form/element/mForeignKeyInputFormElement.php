<?php

class mForeignKeyInputFormElement extends mInputFormElement {
	protected $requiredOptions = array('modelName', 'columns');

	protected $modelName;
	protected $columns;
	protected $hasEmptyChoice = false;
	/**
	 * @var mChoiceInputFormElement
	 */
	protected $widget = null;

	public function getChoices() {
		//TODO: сделать для многих полей
		$columns = array_map(function($a) {return '.' . $a;}, $this->columns);

		$columns = implode(", ',', ", $columns);
		$columns = 'CONCAT(' . $columns . ')';

		$columns =  $this->columns[0];
		$choices = Moskva::getInstance()->getEntityManager()
						->createQuery("
									SELECT m.id, m.{$columns} as columns
									FROM {$this->modelName} m
						")->execute(array(), \Doctrine\ORM\Query::HYDRATE_ARRAY);

		$result = array();

		foreach ($choices as $row) {
			$result[$row['id']] = $row['columns'];
		}

		return $result;
	}

	protected function init() {
		if (!is_array($this->columns)) {
			$this->columns = array($this->columns);
		}

		if ($this->widget === null) {
			$this->widget = new mSelectChoiceInputFormElement(array('choices' => $this->getChoices(), 'hasEmptyChoice' => $this->hasEmptyChoice));
		}

	}

	public function renderInput($attributes = array())
	{
		$id = $this->getValue() ? $this->getValue()->getId() : null;
		$this->widget->setValue($id);
		$this->widget->setName($this->getName());
		return $this->widget->renderInput($attributes);
	}

}