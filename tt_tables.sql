DROP TABLE IF EXISTS posts;
CREATE TABLE posts
(
    id                  SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    publicationDate     DATE NOT NULL,                              -- When the post was published
    title               VARCHAR(255) NOT NULL,                      -- The post's title
    summary             TEXT NOT NULL,                              -- Short summary of the post
    content             MEDIUMTEXT NOT NULL,                        -- The HTML of the post
);