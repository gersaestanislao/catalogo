<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$xml = simplexml_load_file('https://okun.com.mx/gersa/innovacioneducativa.WordPress.2026-04-17.xml');

// Namespaces
$namespaces = $xml->getNamespaces(true);

// CDATA helper
function addChildWithCDATA($parent, $name, $value) {
    $child = $parent->addChild($name);
    $node = dom_import_simplexml($child);
    $no = $node->ownerDocument;
    $node->appendChild($no->createCDATASection($value));
}

// 🔥 Mapa de attachments (ID → URL)
$attachments = [];

foreach ($xml->channel->item as $attItem) {
    $wp = $attItem->children($namespaces['wp']);

    if ((string)$wp->post_type === 'attachment') {
        $id = (string)$wp->post_id;
        $url = (string)$wp->attachment_url;
        $attachments[$id] = $url;
    }
}

// 🔹 XML salida
$output = new SimpleXMLElement('<courses/>');

// 🔥 Loop principal
foreach ($xml->channel->item as $item) {

    $wp = $item->children($namespaces['wp']);

    if ((string)$wp->post_type !== 'post') continue;

    $course = $output->addChild('course');

    // 🔹 Title
    addChildWithCDATA($course, 'title', (string)$item->title);

    // 🔹 ACF
    $acf = [];

    foreach ($wp->postmeta as $meta) {
        $key = (string) $meta->meta_key;
        $value = (string) $meta->meta_value;

        $acf[$key] = $value;
    }

    // 🔥 SOLO CAMPOS NECESARIOS
    $fields = [
        'tema',
        'imageobjet',
        'image',
        'person',
        'objetivo', // corrige aquí si aplica
        'clave',
        'ponente'
    ];

    foreach ($fields as $field) {
        if (!empty($acf[$field])) {

            $value = $acf[$field];

            // 🔹 Convertir ID → URL si es imagen
            if (is_numeric($value) && isset($attachments[$value])) {
                $value = $attachments[$value];
            }

            addChildWithCDATA($course, $field, $value);
        }
    }
}

// Guardar
$output->asXML('output-clean-acf.xml');

echo "XML limpio generados";