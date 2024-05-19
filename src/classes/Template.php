<?php
// This file is for creating templates for the site
namespace classes;

//create a global variable that represents the incrementing id $id;
$global_incrementing_id = 0;

class Template extends Component
{
  protected $name;
  protected $root;
  protected $props;

  public function __construct(string $name, mixed $root, array $props = [])
  {
    global $global_incrementing_id;
    $id = $global_incrementing_id++;

    $this->name = $name;
    $this->root = $root;
    $this->props = $props;

    $children = array_merge($root->getChildren() ?? [], $props['children'] ?? []);
    // call the parent constructor
    parent::__construct(name: $name, htmlTag: $root->htmlTag, attributes: $root->getAttributes(), styles: $root->getStyles(), children: $children, id: $id);
  }

  public function render(): string
  {
    return parent::render();
  }
}
