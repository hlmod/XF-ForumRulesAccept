<?php

/**
 * This file is a part of free add-on "Forum Rules Accept".
 * Developed by HLModerators.
 *
 * License - MIT.
 */

namespace HLModerators\ForumRulesAccept;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $this->alterTable('xf_forum', function (Alter $table)
        {
            $table->addColumn('hlmod_rules_url', 'varchar', 255);
        });
    }

    public function uninstallStep1()
    {
        $this->alterTable('xf_forum', function (Alter $table)
        {
            $table->dropColumns(['hlmod_rules_url']);
        });
    }
}
