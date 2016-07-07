<?php

/**
 * This file is part of the eZ Publish Kernel package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\Search\Common\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\Search\Common\Slot;
use eZ\Publish\SPI\Search\Indexer;
use eZ\Publish\SPI\Search\Indexer\FullTextIndexer;

/**
 * A Search Engine slot handling HideLocationSignal.
 */
class HideLocation extends AbstractSubtree
{
    /**
     * Receive the given $signal and react on it.
     *
     * @param \eZ\Publish\Core\SignalSlot\Signal $signal
     */
    public function receive(Signal $signal)
    {
        if (!$signal instanceof Signal\LocationService\HideLocationSignal) {
            return;
        }

        if (!$this->searchHandler instanceof Indexer || $this->searchHandler instanceof FullTextIndexer) {
            return;
        }

        $this->indexSubtree($signal->locationId);
    }
}
