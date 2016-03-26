<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 18/03/16
 * Time: 17:39
 */

namespace Veloci\Core\Helper\Resultset;


use MongoDB\Driver\Cursor;
use Veloci\Core\Helper\Resultset\Filter\ResultsetFilter;

class MongodbResultset implements Resultset
{
    /**
     * @var Cursor
     */
    private $cursor;

    /**
     * @var ResultsetFilter[]
     *
     */
    private $filters;

    public function __construct(Cursor $cursor)
    {
        $this->cursor = new \IteratorIterator($cursor);
        $this->cursor->rewind();
        $this->filters = [];
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        $current = (array)$this->cursor->current();

        return $this->applyFilters($current);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->cursor->next();
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->cursor->key();
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->cursor->valid();
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->cursor->rewind();
    }

    public function appendFilter(ResultsetFilter $filter)
    {
        $this->filters [] = $filter;
    }

    protected function applyFilters(array $input):array
    {
        foreach ($this->filters as $filter) {
            $filter->apply($input);
        }

        return $input;
    }

    public function toArray():array
    {
        $this->rewind();
        $result = [];

        foreach ($this as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
}