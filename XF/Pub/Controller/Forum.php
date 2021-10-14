<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept\XF\Pub\Controller;


use XF\Mvc\ParameterBag;

class Forum extends XFCP_Forum
{
    protected function setupThreadCreate(\XF\Entity\Forum $forum)
    {
        /** @var string $rulesUrl */
        $rulesUrl = $forum->hlmod_rules_url;
        if (!empty($rulesUrl) && $rulesUrl !== $this->filter('hlmod_rules_url_accept', 'str,no-trim'))
        {
            throw $this->errorException(\XF::phrase('hlmod_forum_rules_accept.you_must_accept_rules'), 400);
        }

        return parent::setupThreadCreate($forum);
    }
}
