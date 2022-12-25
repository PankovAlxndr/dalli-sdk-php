<?php

declare(strict_types=1);

namespace DalliSDK\Responses\Act;

use DalliSDK\Responses\AbstractBase64Response;
use JMS\Serializer\Annotation as JMS;

/**
 * @see  https://api.dalli-service.com/v1/doc/getact
 * @JMS\XmlRoot("getact")
 */
class ActBase64Response extends AbstractBase64Response
{
}
