<?php namespace Anomaly\NavigationModule\Menu;

use Anomaly\NavigationModule\Menu\Command\DeleteMenuLinks;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class MenuObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Menu
 */
class MenuObserver extends EntryObserver
{

    /**
     * Fired after an entry is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->dispatch(new DeleteMenuLinks($entry));

        parent::deleted($entry);
    }
}
