<?php
abstract class mChoiceInputFormElement extends mInputFormElement {
	protected $requiredOptions = array('choices');

	protected $choices;

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
}