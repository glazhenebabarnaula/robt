<?php
abstract class mChoiceInputFormElement extends mInputFormElement {
	protected $requiredOptions = array('choices');

	protected $choices;
	protected $hasEmptyChoice = false;

	public function setChoices($choices)
	{
		$this->choices = $choices;
	}

	public function getChoices()
	{
		return $this->choices;
	}

	public function isChosen($option) {
		return $this->value == $option;
	}

	public function setHasEmptyChoice($isNullable)
	{
		$this->hasEmptyChoice = $isNullable;
	}

	public function getHasEmptyChoice()
	{
		return $this->hasEmptyChoice;
	}
}