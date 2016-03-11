<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 20:24
 */

namespace Veloci\Core\Helper\Serializer\Strategy;


use Veloci\Core\Exception\SerializationException;

class DateTimeStrategy implements PropertySerializationStrategy
{

    /**
     * @var string
     */
    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function serialize($data)
    {
        if ($data instanceof \DateTime) {
            return $data->format($this->format);
        }

        throw new SerializationException("This strategy can't deal with this object. Expected DateTime");
    }

    public function deserialize($data)
    {
        $result = \DateTime::createFromFormat($this->format, $data);

        if (!$result) {
            throw new SerializationException('This strategy fails on deserialize the input data.');
        }

        return $result;
    }
}