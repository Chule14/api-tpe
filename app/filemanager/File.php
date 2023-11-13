<?php


class Filemanager {

    public function saveImage ($image) {
        $target = 'images/' . uniqid() . '.jpg';
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }

}