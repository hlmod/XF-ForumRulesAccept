<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept\ControllerPlugin;


use XF\ControllerPlugin\AbstractPlugin;
use XF\Mvc\Entity\Entity;
use XF\Mvc\FormAction;

class SubforumRules extends AbstractPlugin
{
    /**
     * Performs checking user accept with subforum rules.
     *
     * @param Entity $entity
     */
    public function assertRulesIsAccepted(Entity $entity): void
    {
        /** @var string $rulesUrl */
        $rulesUrl = $entity->hlmod_rules_url;
        if (!empty($rulesUrl) && $rulesUrl !== $this->filter('hlmod_rules_url_accept', 'str,no-trim'))
        {
            throw $this->errorException(\XF::phrase('hlmod_forum_rules_accept.you_must_accept_rules'), 400);
        }
    }

    /**
     * Append the operation for saving the subforum rules URL to entity
     * to already created form action object.
     *
     * @param FormAction $formAction
     * @param Entity $entity
     */
    public function setupSaveUrl(FormAction $formAction, Entity $entity): void
    {
        $formAction->setupEntityInput($entity, [
            'hlmod_rules_url' => $this->filter('hlmod_rules_url', 'str')
        ]);
    }
}
