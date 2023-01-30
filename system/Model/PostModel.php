<?php

namespace system\Model;

use LDAP\Result;
use system\Core\Connection;

class PostModel {


    /**
     *  SELECT query with adjustable parameters. Some as null
     * means the default SELECT * FROM table query
     * @param string $field=null - name of table field
     * @param string $value=null - value to compare as string
     *  
     */
    public function search(string $field=null, string $value=null): bool|array|object
    {
        $where = ( $field && $value ? "WHERE {$field} = {$value}":'');

        $query = "SELECT * FROM posts {$where} ORDER BY id DESC";

        $stmt = Connection::getInstance()->query($query);
        $result =  $stmt->fetchAll(); 

        return $result;
    }
    public function searchForm(string $input=null): bool|array
    {
        // $where = ( $field && $value ? "WHERE {$field} = {$value}":'');

        $query = "SELECT * FROM posts WHERE status = 1 AND title LIKE '%{$input}%' ORDER BY id DESC";

        $stmt = Connection::getInstance()->query($query);
        $result =  $stmt->fetchAll(); 

        return $result;
    }
}