<?php
// app/models/Tag.php
// Model for tags table
class Tag
{
    public $id, $name;
    public static function find($id)
    {
        // ...fetch tag by id...
    }
    public static function all()
    {
        // ...fetch all tags...
    }
    public function save()
    {
        // ...insert or update tag...
    }
    public function delete()
    {
        // ...delete tag...
    }
}
