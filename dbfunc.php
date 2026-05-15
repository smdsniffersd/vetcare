<?php
require_once __DIR__ . '/DataBase.php';

function OneFetch($sql, $params = []) {
    return DataBase::OneFetch($sql, $params);
}

function AllFetch($sql, $params = []) {
    return DataBase::AllFetch($sql, $params);
}

function execu($sql, $params = []) {
    return DataBase::execu($sql, $params);
}

function InsertRow($table, $data = []) {
    return DataBase::insertRow($table, $data);
}

function LastId() {
    return DataBase::lastId();
}