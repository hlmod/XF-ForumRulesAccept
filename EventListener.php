<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept;


use XF\Entity\AddOn;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Manager;
use XF\Mvc\Entity\Structure;
use function count;
use function in_array;

class EventListener
{
    const OPTIONAL_ADD_ONS = [
        'XFRM' => ['xf_rm_category']
    ];

    const ENTITIES = [
        'XF:Forum',
        'XFRM:Category'
    ];

    /**
     * Extends the entity structure
     *
     * @param Manager $em
     * @param Structure $structure
     */
    public static function onEntityStructure(Manager $em, Structure &$structure): void
    {
        if (!in_array($structure->shortName, self::ENTITIES))
        {
            return;
        }

        $structure->columns['hlmod_rules_url'] = ['type' => Entity::STR, 'maxLength' => 255,
            'default' => ''];
    }

    /**
     * Listens the add-on installs for creating tables where this is required.
     *
     * @param \XF\AddOn\AddOn $addOn
     * @param AddOn $installedAddOn
     * @param array $json
     * @param array $stateChanges
     */
    public static function onAddOnInstall(\XF\AddOn\AddOn $addOn, AddOn $installedAddOn,
                                          array $json, array &$stateChanges): void
    {
        $addOnId = $addOn->getAddOnId();
        $tables = self::OPTIONAL_ADD_ONS[$addOnId] ?? [];
        if (!count($tables))
        {
            return;
        }

        /** @var Setup|null $setup */
        $setup = $addOn->getSetup();
        if (!$setup)
        {
            return;
        }

        foreach ($tables as $tableName)
        {
            $setup->addRulesColumn($tableName);
        }
    }
}
