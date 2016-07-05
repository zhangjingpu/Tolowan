<?php
$di->getShared('eventsManager')->attach('formRenderElement:Textarea', function ($event, $element) {
    if (isset($element->options['wordsmith']) && $element->options['wordsmith'] == true) {
        global $di;
        $di->getShared('assets')->addJs('ckeditor','/modules/ckeditor/ckeditor.js','footer')->addInlineJs('ckeditorInit'.ucfirst($element->name),'CKEDITOR.replace( \''.$element->name.'\' );','footer');
        $element->{'#templates'}['widget'] = 'formElement-ckeditor';
        $element->{'#templates'}['widgetLayout'] = 'formElement-ckeditor-' . $element->layout;
    }
    return $element;
});