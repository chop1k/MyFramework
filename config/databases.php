<?php

/**
 * That file returns list of databases, provided by scheme below.
 *
 * 'database_identifier' => [
 *      'provider' => DatabaseProvider::MySQL,
 *      'host' => 'localhost',
 *      'user' => 'username',
 *      'password' => 'password',
 *      'port' => 0000,
 *      'name' => 'test'
 * ]
 *
 * database_identifier represents unique connection name.
 * provider represents database provider, which will be used.
 * name represents database name.
 *
 * Every database is use lazy loading i.e it will connect only if needed.
 */

return [
];