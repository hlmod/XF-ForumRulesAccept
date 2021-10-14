<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept;


use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Manager;
use XF\Mvc\Entity\Structure;

class EventListener
{
    /**
     * Extends the forum entity structure
     *
     * @param Manager $em
     * @param Structure $structure
     */
    public static function onForumEntityStructure(Manager $em, Structure &$structure)
    {
        $structure->columns['hlmod_rules_url'] = ['type' => Entity::STR, 'maxLength' => 255,
            'default' => ''];
    }
}
