<?php
namespace NetworkMap\Form;

use Omeka\Form\Element\HtmlTextarea;
use Zend\Form\Form;

class ConfigForm extends Form
{
    protected $networkMapIsActive;

    public function init()
    {
        $this->add([
            'name' => 'network_map_json',
            'type' => HtmlTextarea::class,
            'options' => [
                'label' => 'JSON Data', // @translate
                'empty_option' => '', // @translate
            ],
        ]);

        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'network_map_json',
            'required' => false,
        ]);
    }

    /**
     * @param bool $networkMapIsActive
     */
    public function setNetworkMapIsActive($networkMapIsActive)
    {
        $this->networkMapIsActive = $networkMapIsActive;
    }

    /**
     * @return bool
     */
    public function getNetworkMapIsActive()
    {
        return $this->networkMapIsActive;
    }
}
