<?php
    include("config/database.php");

    function findById($DBH,$table, $idSearch, $value_primary, $fields = '*') {
        if (!empty($value_primary)) {
            $query = "SELECT $fields FROM `" . $table . "` WHERE `" . $idSearch . "`='$value_primary'";
            $sql = $DBH->prepare($query);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_OBJ);
            return $sql->fetchAll();
        }
        return false;
    }

     function fetchAll($DBH, $table, $where = 1, $fields = '*', $orderby = '1 ASC') {
        $query = "SELECT $fields FROM `" . $table . "` WHERE $where ORDER BY ".$orderby;
        $sql = $DBH->prepare($query);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_OBJ);
        return $sql->fetchAll();
    }
    function insert($DBH, $data, $table) {
        $fieldsList = "";
        $valuesList = "";
        foreach ($data as $k => $v) {
            $fieldsList .= "`$k`, ";
            $valuesList .= $DBH->quote($v) . ", ";
        }
        $fieldsList = substr($fieldsList, 0, -2);
        $valuesList = substr($valuesList, 0, -2);
        $query = "INSERT INTO `" . $table . "` ($fieldsList) VALUES ($valuesList)";
        $sql = $DBH->prepare($query);
        return $sql->execute();
    }
    function update($DBH, $table, $data, $where) {
        if (!empty($where)) {
            $fieldsListAndValue = "";
            foreach ($data as $k => $v) {
                $fieldsListAndValue .= "`$k`=" . $DBH->quote($v) . ", ";
            }
            $fieldsListAndValue = substr($fieldsListAndValue, 0, -2);
            $query = "UPDATE " . $table . " SET $fieldsListAndValue WHERE $where";
            $sql = $DBH->prepare($query);
            return $sql->execute();
        }
        return false;
    }
    function delete($DBH, $table, $idSearch, $value_primary) {
        if (!empty($value_primary)) {
            $query = "DELETE FROM `" . $table . "` WHERE `" . $idSearch . "`='$value_primary' LIMIT 1";
            $sql = $DBH->prepare($query);
            return $sql->execute();
        }
        return false;
    }

    function massDelete($DBH, $table, $where) {
        if (!empty($where)) {
            $query = "DELETE FROM `" . $table . "` WHERE $where";
            $sql = $DBH->prepare($query);
            return $sql->execute();
        }
        return false;
    }
