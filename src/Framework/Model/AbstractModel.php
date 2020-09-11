<?php


namespace Framework\Model;

/**
 * Class AbstractModel from which inherits models.
 * @package Framework\Model
 */
class AbstractModel
{
    /**
     * Contains Query provider which need for accessing queries from config.
     * @var QueryProvider $queryProvider
     */
    public QueryProvider $queryProvider;
}