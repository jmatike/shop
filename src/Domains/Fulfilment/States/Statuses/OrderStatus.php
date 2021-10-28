<?php

declare(strict_types=1);

namespace Domains\Fulfilment\States\Statuses;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self pending()
 * @method static self delined()
 * @method static self completed()
 * @method static self refunded()
 * @method static self cancelled()
 */
final class OrderStatus extends Enum {}