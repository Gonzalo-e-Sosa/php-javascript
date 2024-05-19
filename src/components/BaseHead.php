<?php

use classes\Component;
use classes\Template;

$baseHead = function (string $title, string $description = '') {
  $meta = new Component(
    name: 'Meta',
    htmlTag: 'meta',
  );
  $title = new Component(
    name: 'Title',
    htmlTag: 'title',
    content: array($title),
  );
  $favicon = new Component(
    name: 'Favicon',
    htmlTag: 'link',
    attributes: [
      'rel' => 'icon',
      'type' => 'image/png',
      'href' => '/favicon.png',
    ],
  );
  $head = new Component(
    name: 'Head',
    htmlTag: 'head',
    children: [
      $meta->setAttributes(['charset' => 'utf-8']),
      $meta->setAttributes([
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1'
      ]),
      $meta->copy()->setAttributes(['name' => 'description', 'content' => $description]),
      $favicon,
      $title,
    ]
  );

  return new Template(
    name: 'BaseHead',
    root: $head
  );
};
