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

    const TABLES = ['xf_forum', 'xf_rm_category'];

    #region Install steps

    /**
     * Adds the columns to required tables (if exists).
     */
    public function installStep1(): void
    {
        foreach (self::TABLES as $tableName)
        {
            $this->addRulesColumn($tableName);
        }
    }

    #endregion

    #region Upgrade steps

    /**
     * Sets the default column value for correct working if add-on is
     * disabled.
     */
    public function upgrade1000011Step1(): void
    {
        $this->alterTable('xf_forum', function (Alter $table)
        {
            $table->changeColumn('hlmod_rules_url')
                ->setDefault('');
        });
    }

    /**
     * Adds the column to XFRM table (if exists).
     */
    public function upgrade1000210Step1(): void
    {
        $this->addRulesColumn('xf_rm_category');
    }

    #endregion

    #region Uninstall steps

    /**
     * Drops the column from all tables.
     */
    public function uninstallStep1(): void
    {
        foreach (self::TABLES as $tableName)
        {
            $this->dropRulesColumn($tableName);
        }
    }

    #endregion

    /**
     * Adds the column for rules URL saving in specified table.
     *
     * @param string $tableName
     */
    public function addRulesColumn(string $tableName): void
    {
        if (!$this->tableExists($tableName))
        {
            return;
        }

        $this->alterTable($tableName, function (Alter $table)
        {
            $table->addColumn('hlmod_rules_url', 'varchar', 255)
                ->setDefault('');
        });
    }

    /**
     * Drops the column for rules URL saving in specified table.
     *
     * @param string $tableName
     */
    public function dropRulesColumn(string $tableName): void
    {
        if (!$this->tableExists($tableName))
        {
            return;
        }

        $this->alterTable($tableName, function (Alter $table)
        {
            $table->dropColumns(['hlmod_rules_url']);
        });
    }
}
