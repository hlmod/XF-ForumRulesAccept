<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept\XF\Admin\Controller;


use XF\Mvc\FormAction;

class Forum extends XFCP_Forum
{
    protected function saveTypeData(FormAction $form, \XF\Entity\Node $node, \XF\Entity\AbstractNode $data)
    {
        parent::saveTypeData($form, $node, $data);

        $this->plugin('HLModerators\ForumRulesAccept:SubforumRules')
            ->setupSaveUrl($form, $data);
    }
}
