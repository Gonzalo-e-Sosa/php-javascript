<?php

declare(strict_types=1);

use classes\Component;
use classes\Template;

require_once __DIR__ . '/classes/Component.php';
require_once __DIR__ . '/classes/Template.php';
require_once __DIR__ . '/layouts/BaseLayout.php';
require_once __DIR__ . '/components/BaseHead.php';

/* TODO: install curl or fix htpps on file_get_contents

function url_get_contents($Url)
{
  if (!function_exists('curl_init')) {
    die('CURL is not installed!');
  }
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $Url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

$person = json_decode(url_get_contents('https://randomuser.me/api/?nat=es,us,mx'))['results'][0];
*/

$lang = 'es';
$body = new Template(
  name: 'body',
  root: new Component(name: 'Body', htmlTag: 'body')
);
$nav = new Component(name: 'Nav', htmlTag: 'nav');
$anchor = new Component(name: 'Anchor', htmlTag: 'a');
$header = new Component(
  name: 'Header',
  htmlTag: 'header',
  children: [
    $anchor->copy()->setAttributes(['href' => 'index.php'])->setContent(['Logo']),
    $nav->setChildren([
      $anchor->copy()->setAttributes(['href' => 'index.php'])->setContent(['Home']),
      $anchor->copy()->setAttributes(['href' => 'about.php'])->setContent(['About']),
      $anchor->copy()->setAttributes(['href' => 'contact.php'])->setContent(['Contact']),
    ])
  ]
);
$main = new Component(
  name: 'Main',
  htmlTag: 'main',
  content: [$person['name']['first'] . ' ' . $person['name']['last']]
);
$footer = new Component(name: 'Footer', htmlTag: 'footer');

?>

<?= $baseLayout(
  lang: $lang,
  head: $baseHead(title: "My App", description: "A basic site with php."),
  body: $body->setChildren(
    [
      $header,
      $main,
      $footer
    ]
  )
)
?>

<script>
  const API_URL = 'https://randomuser.me/api/?nat=es,us,mx';
  fetch(API_URL)
    .then(response => response.json())
    .then(data => console.log(data.results[0]));
</script>

<style>
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  nav {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }
</style>