<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept\XFRM\Admin\Controller;


class Category extends XFCP_Category
{
    protected function categorySaveProcess(\XFRM\Entity\Category $category)
    {
        $formAction = parent::categorySaveProcess($category);
        $this->plugin('HLModerators\ForumRulesAccept:SubforumRules')
            ->setupSaveUrl($formAction, $category);

        return $formAction;
    }
}
