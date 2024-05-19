<?php

namespace classes;

class Component
{
  protected $id;
  protected $name;
  protected $htmlTag;
  protected $attributes;
  protected $styles;
  protected $content;
  protected $children;


  /**
   * Constructor for the class.
   *
   * @param string $name The name of the object.
   * @param string $htmlTag The htmlTag of the object.
   * @param array $attributes The attributes of the object (default: []).
   * @param array $styles The styles of the object (default: []).
   * @param array $content The content of the object (default: []).
   * @param array $children The children of the object (default: []).
   * @param int $id The ID of the object.
   */
  public function __construct(string $name, string $htmlTag, array $attributes = [], array $styles = [], array $content = [], array $children = [], int $id = 0)
  {
    $this->name = $name;
    $this->htmlTag = $htmlTag;
    $this->attributes = $attributes;
    $this->styles = $styles;
    $this->content = $content;
    $this->children = $children;
    $this->id = $id ?? rand(10000, 99999);
  }

  public function __destruct()
  {
    unset($this->id, $this->htmlTag, $this->content, $this->children);
  }

  /**
   * Renders the component and its children recursively as an HTML string.
   *
   * @return string The rendered HTML string.
   */
  public function render()
  {
    if (count($this->children) > 0) {
      $html = "
        <{$this->htmlTag} 
          {$this->attributesToString($this->attributes)}
          {$this->stylesToString($this->styles)}
        >{$this->contentToString($this->content)}
      ";
      foreach ($this->children as $child) {
        $html .= $child->render();
      }
      $html .= "</{$this->htmlTag}>";
      return $html;
    }
    return "
      <{$this->htmlTag} 
        {$this->attributesToString($this->attributes)} 
        {$this->stylesToString($this->styles)}
      >
        {$this->contentToString($this->content)}
      </{$this->htmlTag}>
    ";
  }

  public function copy()
  {
    return clone $this;
  }

  static function contentToString(array $content): string
  {
    $string = '';
    foreach ($content as $d) {
      $string .= $d;
    }
    return $string;
  }

  static function attributesToString(array $attributes): string
  {
    if (count($attributes) === 0) {
      return '';
    }
    $string = '';
    foreach ($attributes as $key => $value) {
      $string .= " {$key}=\"{$value}\"";
    }
    return $string;
  }

  static function stylesToString(array $styles): string
  {
    if (count($styles) === 0) {
      return '';
    }
    $string = 'style="';
    foreach ($styles as $key => $value) {
      $string .= "{$key}:{$value};";
    }
    return $string . '"';
  }
  // Getters
  public function getId()
  {
    return $this->id;
  }

  public function gethtmlTag()
  {
    return $this->htmlTag;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getAttributes()
  {
    return $this->attributes;
  }

  public function getStyles()
  {
    return $this->styles;
  }

  public function getcontent()
  {
    return $this->content;
  }

  public function getChildren()
  {
    return $this->children;
  }

  // Setters
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }

  public function sethtmlTag($htmlTag)
  {
    $this->htmlTag = $htmlTag;
    return $this;
  }

  public function setName($name)
  {
    $this->name = $name;
    return $this;
  }

  public function setAttributes($attributes)
  {
    $this->attributes = $attributes;
    return $this;
  }

  public function setStyles($styles)
  {
    $this->styles = $styles;
    return $this;
  }

  public function setContent($content)
  {
    $this->content = $content;
    return $this;
  }

  public function setChildren($children)
  {
    $this->children = $children;
    return $this;
  }
}
