<?php


function validatePost($post)
{
    $errors = array();
    if (empty($post['title'])) {
        array_push($errors, 'Title est demandé');
    }

    if (empty($post['content'])) {
        array_push($errors, 'Le corps est demandé');
    }
    if (empty($post['tag'])) {
        array_push($errors, 'tags sont demandé');
    }
    return $errors;
}