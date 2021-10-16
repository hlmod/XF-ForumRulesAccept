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
    public function actionPostThread(ParameterBag $params)
    {
        if ($this->isPost())
        {
            $userId = \XF::visitor()->user_id;
            $nodeId = $params->node_id ?: $params->node_name;
            $node = $this->assertViewableForum($nodeId, ['DraftThreads|' . $userId]);

            $this->plugin('HLModerators\ForumRulesAccept:SubforumRules')
                ->assertRulesIsAccepted($node);
        }

        return parent::actionPostThread($params);
    }
}
