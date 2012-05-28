<?php
class mSelectChoiceInputFormElement extends mChoiceInputFormElement {
	public function renderInput($attributes = array())
	{
		$options = array();

		foreach ($this->getChoices() as $key => $label) {
			$optionAttributes = array('value' => $key);

			if ($this->isChosen($key)) {
				$optionAttributes['selected'] = 'selected';
			}

			$options[] = $this->renderTag('option', $label, $optionAttributes);
		}

		$optionsImploded = implode('', $options);

		return $this->renderTag('select', $optionsImploded, array_merge($attributes, array('name' => $this->name)));
	}
}