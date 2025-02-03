<?php
namespace Alberto\DatabaseAbstraction;

interface DatabaseQueryResultContract
{
    public function fetch();
    public function fetchAll();
}
