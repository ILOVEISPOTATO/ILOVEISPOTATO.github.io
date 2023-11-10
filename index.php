<?php
$host = 'localhost';
$db = 'forumDB';

$pdo = new PDO("pgsql:host=$host;dbname=$db");

$query = $pdo->prepare('CREATE TABLE IF NOT EXISTS topics (id SERIAL PRIMARY KEY, title TEXT NOT NULL, post TEXT NOT NULL);');
$query->execute();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $post = $_POST['post'];
    $query = $pdo->prepare('INSERT INTO topics (title, post) VALUES (:title, :post);');
    $query->execute(['title' => $title, 'post' => $post]);
}

$query = $pdo->prepare('SELECT * FROM topics ORDER BY id DESC LIMIT 10;');
$query->execute();
$topics = $query->fetchAll();

include 'forum.htm';
?>
