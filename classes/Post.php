<?php
/**
 * Class that handles all posts
 * 
 * TO DO:
 * - filter Post characters so that no malicious code gets sent with the post submission
 *   (maybe implement HTML-Purifier for this purpose?)
 * - implement uploader for post images
 * - implement a WYSIWYG Html editor
 * - maybe split a post-manager-object from this almost-god-object
 *   
 */

class Post
{
    /**
     * Properties duplicated from the tt_tables.sql database
     */
    public $id = null;
    public $publicationDate = null;
    public $title = null;
    public $summary = null;
    public $content = null;

    /**
     * Constructs the Post-object, sets its properties using the values in the supplied array
     */
    public function __construct($data=array()) {
        if(isset($data['id'])) {
            $this->id = (int)$data['id'];
        };

        if(isset($data['publicationDate'])) {
            $this->publicationDate = (int)$data['publicationDate'];
        };

        if(isset($data['title'])) {
            $this->title = $data['title'];
        }

        if(isset($data['summary'])) {
            $this->summary = $data['summary'];
        }

        if(isset($data['content'])) {
            $this->content = $data['content'];
        }
    }

    /**
     * Sets the Post-object's properties using the edit form post values in the supplied array
     */
    public function storeFormInput($params) {
        // Stores all the Post-object's parameters
        $this->__construct($params);

        // Store Post-object's publication date
        if (isset($params['publicationDate'])) {
            $publicationDate = explode('-', $params['publicationDate']);

            if (count($publicationDate) == 3) {
                list($y, $m, $d) = $publicationDate;
                $this->publicationDate = mktime(0, 0, 0, $m, $d, $y);
            }
        }
    }

    /**
     * Returns Post-object that matches the supplied id
     */
    public function getById($id) {
        // Create DB connection using parameters in config.php
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check DB connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM posts WHERE id = " . $id;
        $result = $connection->query($sql) or die($connection->error);
        $row = $result->fetch_array(MYSQLI_BOTH);
        $connection->close();

        if ($row) {
            return new Post($row);
        }

    }

    /**
     * Returns all or a range of Post-objects from the DB. By default queries all (uh... actually 1000).
     */
    public static function getList($numRows = 9999) {
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($connection->connect_error) {
            echo $connection->connect_error;
        }
        
        // Get an array of the last @numRows existing Post-objects, where @numRows is the supplied of objects.
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM posts ORDER BY publicationDate DESC LIMIT " . $numRows;
        $result = $connection->query($sql) or die($connection->error);
        $list = array();

        while ($row = $result->fetch_array(MYSQLI_BOTH)) {
            $post = new Post($row);
            $list[] = $post;
        }

        // Get the total number of articles that matched the previous query
        $sql = "SELECT COUNT(*) AS totalRows FROM posts";
        $totalRows = $connection->query($sql)->fetch_array(MYSQLI_BOTH);
        $connection->close();

        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    /**
     * Insert current Post-object into the DB
     */
    public function insert() {
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
        if ($connection->connect_error) {
            echo $connection->connect_error;
        }        
        // Prepare and bind
        $stmt = $connection->prepare("INSERT INTO posts (publicationDate, title, summary, content) VALUES (FROM_UNIXTIME(?), ?, ?, ?)");
        $stmt->bind_param("isss", $postDate, $postTitle, $postSummary, $postContent);
        
        // Set parameters and execute
        $postDate = $this->publicationDate;
        $postTitle = $this->title;
        $postSummary = $this->summary;
        $postContent = $this->content;
        $stmt->execute();
        $this->id = $connection->insert_id; 

        $stmt->close();
        $connection->close();
    }

    /**
     * Updates current Post-object into the DB
     */
    public function update() {
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
        if ($connection->connect_error) {
            echo $connection->connect_error;
        }
        // Prepare and bind
        $stmt = $connection->prepare("UPDATE posts SET publicationDate = FROM_UNIXTIME(?), title = ?, summary = ?, content = ? WHERE id = ?");
        $stmt->bind_param("isssi", $postDate, $postTitle, $postSummary, $postContent, $postId);
        
        // Set parameters and execute
        $postDate = $this->publicationDate;
        $postTitle = $this->title;
        $postSummary = $this->summary;
        $postContent = $this->content;
        $postId = $this->id;
        $stmt->execute();

        $stmt->close();
        $connection->close();
    }
    
    /**
     * Deletes current Post-object into the DB
     */
    public function delete() {
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if ($connection->connect_error) {
            echo $connection->connect_error;
        }
        // Prepare and bind
        $stmt = $connection->prepare("DELETE FROM posts WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $postId);
        
        // Set parameters and execute
        $postId = $this->id;
        $stmt->execute();
        
        $stmt->close();
        $connection->close();
    }
}
?>