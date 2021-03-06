<?php

declare(strict_types=1);

/*
 * This file is part of the IOTA PHP package.
 *
 * (c) Benjamin Ansbach <benjaminansbach@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IOTA\RemoteApi\Actions\InterruptAttachingToTangle;

use IOTA\RemoteApi\AbstractAction;
use IOTA\RemoteApi\AbstractResult;
use IOTA\RemoteApi\Exception;

/**
 * Class Action.
 *
 * Interrupts and completely aborts the attachToTangle process.
 *
 * @see https://iota.readme.io/docs/interruptattachingtotangle
 */
class Action extends AbstractAction
{
    /**
     * Gets the data that should be sent to the nodes endpoint.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'command' => 'interruptAttachingToTangle',
        ];
    }

    /**
     * Executes the request.
     *
     * @throws Exception
     *
     * @return AbstractResult|Result
     */
    public function execute(): Result
    {
        $response = new Result($this);
        $srvResponse = $this->nodeApiClient->send($this);
        $response->initialize($srvResponse['code'], $srvResponse['raw']);

        return $response->finish()->throwOnError();
    }
}
