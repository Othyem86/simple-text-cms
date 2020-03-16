<?php
/**
 * Insert the config file and check if the the user action is set or not. If not => set to "".
 * 
 * config.php already contains Post.php
 *  
 */ 
require_once('./config.php');
$action = isset($_GET['action']) ? $_GET['action'] : "";

// Decide which action to perform
switch($action) {
    case 'archive':
        archive();
    break;
    case 'viewPost':
        viewPost();
    break;
    default:
        homepage();
}

/**
 * Functions for user actions
 */

function homepage() {
    $results = array();
    $data = Post::getList(HOMPAGE_POST_NUM);
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "BOTTLE CAP";
    require_once(TEMPLATE_PATH . "/homepage.php");
}

function archive() {
    $results = array();
    $data = Post::getList();
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "ARCHIVE | BOTTLE CAP";
    require_once(TEMPLATE_PATH . "/archive.php");
}

function viewPost() {
    if (!isset($_GET['postId']) || !$_GET['postId']) {
        homepage();
        return;
    }
    $results = array();
    $results['post'] = Post::getById((int)$_GET['postId']);
    $results['pageTitle'] = $results['post']->title . " | BOTTLE CAP";
    require_once(TEMPLATE_PATH . "/viewPost.php");
}
?>