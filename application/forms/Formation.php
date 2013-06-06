<?php

class Application_Form_Formation extends Zend_Form
{

    public function init()
    {
        /* Nom */
        $element = new Zend_Form_Element_Text("nom");
        $element->setLabel("Nom")
                ->setRequired();
        $this->addElement($element);
        
        // Obligatoire
        // Inférieur à 255 caractères
        // Doit être unique dans la base
        // Trim
        // StripTags
        $validator = new Zend_Validate_StringLength();
        $validator->setMax(255);
        $element->addValidator($validator);
        
        $validator = new Zend_Validate_Db_NoRecordExists(array(
            'adapter' => Zend_Db_Table::getDefaultAdapter(),
            'schema' => 'formation_zend',
            'table' => 'formation',
            'field' => 'nom'
        ));
        $element->addValidator($validator);
        
        $filter = new Zend_Filter_StringTrim();
        $element->addFilter($filter);
        
        $filter = new Zend_Filter_StripTags();
        $element->addFilter($filter);
        
        /* Prix */
        $element = new Zend_Form_Element_Text("prix");
        $element->setLabel("Prix")
                ->setRequired();
        $this->addElement($element);
        
        $filter = new Zend_Filter_StringTrim();
        $element->addFilter($filter);
        
        $validator = new Zend_Validate_Float();
        $validator->setLocale("fr_FR");
        $validator->setMessage("La valeur '%value%' n'est pas un nombre", Zend_Validate_Float::NOT_FLOAT);
        $element->addValidator($validator);
        
        $validator = new Zend_Validate_Between(array(
            'min' => 0,
            'max' => 5000
        ));
        $element->addValidator($validator);
        
        /* Submit */
        $element = new Zend_Form_Element_Submit("submit");
        $element->setLabel("Enregistrer");
        $this->addElement($element);
    }


}

