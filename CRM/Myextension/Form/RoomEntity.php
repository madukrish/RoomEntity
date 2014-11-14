<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Myextension_Form_RoomEntity extends CRM_Core_Form {
  function buildQuickForm() {

    // add form elements
    /* 
    $this->add(
      'select', // field type
      'favorite_color', // field name
      'Favorite Color', // field label
      $this->getColorOptions(), // list of options
      true // is required 
    );
     */
    $this->add(
      'text', // field type
      'room_label', // field name
      'Room Label', // field label
      $this->getRoomLabel(),
      true // is required
    ); 
    $this->add(
      'text', // field type
      'room_number', // field name
      'Room Number' // field label
    ); 
    $this->add(
      'text', // field type
      'room_floor', // field name
      'Room Floor' // field label
    ); 
    $this->add(
      'text', // field type
      'room_ext', // field name
      'Room Extension' // field label
    ); 
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  function postProcess() {
    $values = $this->exportValues();
    $options = $this->getRoomLabel();
    /*
    CRM_Core_Session::setStatus(ts('You picked color "%1"', array(
      1 => $options[$values['room_label']]
    )));
    */
    parent::postProcess();
    //save to database
    civicrm_room('room_label', 'create', $options); 
  }

  /* 
  function getColorOptions() {
    $options = array(
      '' => ts('- select -'),
      '#f00' => ts('Red'),
      '#0f0' => ts('Green'),
      '#00f' => ts('Blue'),
      '#f0f' => ts('Purple'),
    );
    foreach (array('1','2','3','4','5','6','7','8','9','a','b','c','d','e') as $f) {
      $options["#{$f}{$f}{$f}"] = ts('Grey (%1)', array(1 => $f));
    }
    return $options;
  }
  */
  
  function getRoomLabel(){
    return;
  }
  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }
}
