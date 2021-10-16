<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept\XFRM\Pub\Controller;


use XF\Mvc\ParameterBag;

class Category extends XFCP_Category
{
    public function actionAdd(ParameterBag $params)
    {
        if ($this->isPost())
        {
            $nodeId = $params->resource_category_id;
            $node = $this->assertViewableCategory($nodeId);

            $this->plugin('HLModerators\ForumRulesAccept:SubforumRules')
                ->assertRulesIsAccepted($node);
        }

        return parent::actionAdd($params);
    }
}
