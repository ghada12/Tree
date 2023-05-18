<?php
$data = array(
  array("name" => "SYT42015", "parent" => "", "id" => "SYT42015"),
  array("name" => "SY42015", "parent" => "SYT42015", "id" => "SY42015"),
  array("name" => "SY158985", "parent" => "SY42015", "id" => "SY158985"),
  array("name" => "SY5071450", "parent" => "SY42015", "id" => "SY5071450"),
  array("name" => "AY15800023", "parent" => "SY42015", "id" => "AY15800023"),
  array("name" => "SY42016", "parent" => "SYT42015", "id" => "SY42016"),
  array("name" => "AY15800023", "parent" => "SY42016", "id" => "AY15800023"),
  array("name" => "AY15800023", "parent" => "SY42016", "id" => "AY15800023"),
);

// Define a class to represent a node in the tree
class Node {
  public $id;
  public $name;
  public $children = array();
  public $parent = null;

  public function __construct($id, $name)
  {
    $this->id = $id;
    $this->name = $name;
  }

  public function addChild(Node $node)
  {
    $node->parent = $this;
    $this->children[] = $node;
  }
}

// Function to recursively display a node and its children
function displayNode(Node $node, $level = 0) {
  // Display the current depth level and the node name
  echo "<li class='item-tree'>";
  echo "<div class='collapsible'>" . str_repeat('&nbsp;&nbsp;&nbsp;', $level) . "<span class='icon'></span>" . $node->name . "</div>";

  // Display each child recursively
  if (count($node->children) > 0) {
    echo "<ul class='level-tree'>";
    foreach ($node->children as $child) {
      displayNode($child, $level + 1);
    }
    echo "</ul>";
  }

  echo "</li>";
}

// Create an array to store nodes by ID
$nodesById = array();

// Loop through the data and create nodes for each entry
foreach ($data as $entry) {
  $node = new Node($entry['id'], $entry['name']);
  $nodesById[$entry['id']] = $node;

  // If the node has a parent, add the node as a child of the parent
  if (!empty($entry['parent'])) {
    $parent = $nodesById[$entry['parent']];
    $parent->addChild($node);
  }
}

// Find the root node (the one with no parent)
$root = null;
foreach ($nodesById as $node) {
  if (empty($node->parent)) {
    $root = $node;
    break;
  }
}

// Function to recursively display a node and its children as HTML
function displayNodeHtml(Node $node) {
    echo '<div class="node">';
    echo '<div class="name">' . $node->name . '</div>';

    if (!empty($node->children)) {
        echo '<div class="children">';
        foreach ($node->children as $child) {
            displayNodeHtml($child);
        }
        echo '</div>';
    }

    echo '</div>';
}
?>