<?php
namespace NetworkMap\Site\BlockLayout;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Omeka\Form\Element\HtmlTextarea;
use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Entity\SitePageBlock;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Stdlib\ErrorStore;
use Zend\View\Renderer\PhpRenderer;
use Zend\ServiceManager\ServiceLocatorInterface;

class NetworkMap extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Network Map'; // @translate
    }

    public function prepareForm(PhpRenderer $view)
    {
        $view->headLink()->appendStylesheet($view->assetUrl('css/network-map-admin.css', 'NetworkMap'));
    }

    public function form(PhpRenderer $view, SiteRepresentation $site,
        SitePageRepresentation $page = null, SitePageBlockRepresentation $block = null
    ) {
        $html = '';
        $json = new HtmlTextarea("o:block[__blockIndex__][o:data][network_map_json]");

        
        if ($block && $block->dataValue('network_map_json')) {
            $json->setAttribute('value', $block->dataValue('network_map_json'));
        }

        $html .= '<div class="field"><div class="field-meta">';
        $html .= '<label>' . $view->translate('JSON') . '</label>';
        $html .= '</div>';
        $html .= '<div class="inputs">' . $view->formRow($json) . '</div>';
        $html .= '</div>';
        
        return $html;
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block)
    {
        $view->headLink()->appendStylesheet($view->assetUrl('css/network-map-public.css', 'NetworkMap'));
        $view->headScript()->appendFile($view->assetUrl('js/jquery-3.3.1.min.js', 'NetworkMap'), 'text/javascript');
        $view->headScript()->appendFile($view->assetUrl('js/d3.v3.min.js', 'NetworkMap'), 'text/javascript');
        $view->headScript()->appendFile($view->assetUrl('js/network-map-public.js', 'NetworkMap'), 'text/javascript');

        return $view->partial('common/block-layout/network-map-block', [
            'block' => $block,
            'json' => $block->dataValue('network_map_json'),
        ]);
    }
}