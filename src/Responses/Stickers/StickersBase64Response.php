<?php

declare(strict_types=1);

namespace DalliSDK\Responses\Stickers;

use DalliSDK\Responses\AbstractBase64Response;
use JMS\Serializer\Annotation as JMS;

/**
 * @see  https://api.dalli-service.com/v1/doc/getact
 * @JMS\XmlRoot("stickers")
 */
class StickersBase64Response extends AbstractBase64Response
{
}
