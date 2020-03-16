<?php
/**
 * Insert the config file and check if the the admin username and action is set or not. If not => set to "".
 * Session is required to track admin logged in/out status
 * config.php already contains Post.php
 */ 

require_once("config.php");
session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

if ($action != "login" && $action != "logout" && !$username) {
    login();
    exit;
}

// Decide which admin actions to perform
switch ($action) {
    case 'login':
        login();
    break;
    case 'logout':
        logout();
    break;
    case 'newPost':
        newPost();
    break;
    case 'editPost':
        editPost();
    break;
    case 'deletePost':
        deletePost();
    break;
    default:
        listPosts();
}

/**
 * Functions for user actions
 */

 // Logs the user in
function login() {
    $results = array();
    $results['pageTitle'] = "Admin Login | THE THING TITLE";

    if (isset($_POST['login'])) {
        // After the user posts the login form, attempt to log in the user
        if($_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD) {
            // Login was successful: Create a session and redirect user to admin.php
            $_SESSION['username'] = ADMIN_USERNAME;
            header("Location: admin.php");
        } else {
            // Login failed: display error to the user
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require_once(TEMPLATE_PATH . "/admin/loginForm.php");
        }
    } else {
        // The User has not posted the login form. Display the form for him
        require_once(TEMPLATE_PATH . "/admin/loginForm.php");
    }
}

// Logs the user out
function logout() {
    unset($_SESSION['username']);
    header("Location: admin.php");
}

// Creates a new post
function newPost() {
    $results = array();
    $results['pageTitle'] = "New Post";
    $results['formAction'] = "newPost";

    if (isset($_POST['saveChanges'])) {
        // User has posted the post edit form: save the new post
        $post = new Post;
        $post->storeFormInput($_POST);
        $post->insert();
        header("Location: admin.php?status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        // User has cancelled their edits: return to the post list
        header("Location: admin.php");
    } else {
        // User has not posted the post edit form yet: display the form
        $results['post'] = new Post;
        require_once(TEMPLATE_PATH . "/admin/editPost.php");
    }
}

function editPost() {
    $results = array();
    $results['pageTitle'] = "Edit Post";
    $results['formAction'] = "editPost";

    if (isset($_POST['saveChanges'])) {
        // User has posted the post edit form: save the post changes
        if (!$post = Post::getById((int)$_POST['postId'])) {
            header( "Location: admin.php?error=postNotFound" );
            return;
        }
        $post->storeFormInput($_POST);
        $post->update();
        header("Location: admin.php?status=changesSaved");
    } elseif (isset($_POST['cancel'])) {
        // User has cancelled their edits. Return to the post list
        header("Location: admin.php");
    } else {
        // User has not yet posted the post edit form. Display the form for the user
        $results['post'] = Post::getById((int)$_GET['postId']);
        require_once(TEMPLATE_PATH . "/admin/editPost.php");
  }
}

function deletePost() {
    if (!$post = Post::getById((int)$_GET['postId'])) {
        header("Location: admin.php?error=postNotFound");
        return;
    }

    $post->delete();
    header("Location: admin.php?status=postDeleted");
}

function listPosts() {
    $results = array();
    $data = Post::getList();
    $results['posts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Posts";

    if (isset($_GET['error'])) {
        if ($_GET['error'] == "postNotFound" ) $results['errorMessage'] = "Error: Post not found.";
    }

    if (isset( $_GET['status'])) {
        if ($_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ($_GET['status'] == "postDeleted" ) $results['statusMessage'] = "Post deleted.";
    }
    require_once( TEMPLATE_PATH . "/admin/listPosts.php" );
}
?>