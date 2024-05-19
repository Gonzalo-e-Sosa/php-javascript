<?php

use classes\Component;
use classes\Template;

$baseLayout = function (string $lang, mixed $head, mixed $body): string {
  $html = new Component(
    name: 'html',
    htmlTag: 'html',
    attributes: [
      'lang' => $lang ?? 'en'
    ],
    children: [
      $head,
      $body
    ]
  );

  $layout = new Template(
    name: 'layout',
    root: $html
  );

  return "<!DOCTYPE html>" . $layout->render();
};
