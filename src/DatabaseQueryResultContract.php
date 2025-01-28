<?php
namespace Alberto\SakilaPhpTest;

interface DatabaseQueryResultContract
{
    public function fetch();
    public function fetchAll();
}
