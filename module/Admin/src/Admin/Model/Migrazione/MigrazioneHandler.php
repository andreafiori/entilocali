<?php

namespace Admin\Model\Migrazione;

use Admin\Model\Logs\LogsWriter;
use Application\Model\Database\Redbean\RedbeanHelper;
use Application\Model\NullException;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\Database\Redbean\R;

/**
 * @author Andrea Fiori
 * @since  21 February 2015
 */
class MigrazioneHandler extends RouterManagerAbstract implements RouterManagerInterface
{
    private $arrayMap = array(
        'sezioni'                     => 'Admin\Model\Sezioni\SezioniMigrator',
        'sotto-sezioni'               => 'Admin\Model\Sezioni\SottoSezioniMigrator',
        'albo-pretorio'               => 'Admin\Model\AlboPretorio\AlboPretorioMigrator',
        'contenuti'                   => 'Admin\Model\Contenuti\ContenutiMigrator',
        'contenuti-allegati'          => 'Admin\Model\Contenuti\ContenutiAllegatiMigrator',
        'stato-civile'                => 'Admin\Model\StatoCivile\StatoCivileMigrator',
        'atti-concessione'            => 'Admin\Model\AttiConcessione\AttiConcessioneMigrator',
        'contratti-pubblici'          => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciMigrator',
        'contratti-pubblici-allegati' => 'Admin\Model\ContrattiPubblici\ContrattiPubbliciAllegatiMigrator',
        'users'                       => 'Admin\Model\Users\UsersMigrator',
    );

    public function setupRecord()
    {
        $param = $this->getInput('param',1);

        if (isset($param['post']['migrationoldcms'])) {

            $configFromServiceLocator = $this->getInput('serviceLocator', 1)->get('config');
            $connectionParams = $configFromServiceLocator['doctrine']['connection']['orm_default']['params'];
            R::setup('mysql:host='.$connectionParams['host'].';dbname='.$connectionParams['dbname'], $connectionParams['user'], $connectionParams['password']);

            foreach($param['post']['migrationoldcms'] as $migrazioneOld) {
                if(!array_key_exists($migrazioneOld, $this->arrayMap)) {

                } else {

                    if (!class_exists($this->arrayMap[$migrazioneOld])) {
                        throw new NullException($this->arrayMap[$migrazioneOld].' class does not exist');
                    }

                    /**
                     * @var MigratorAbstract $migrator
                     */
                    $migrator = new $this->arrayMap[$migrazioneOld]($this->getInput());
                    $migrator->setRedbeanHelper(new RedbeanHelper());
                    $migrator->setLogWriter(new LogsWriter($this->getInput('entityManager', 1)->getConnection()));
                    $migrator->setUserDetails($this->getInput('userDetails',1));
                    $migrator->setForeignKeyChecks(0);
                    $migrator->migrate();
                    $migrator->setForeignKeyChecks(1);
                    $migrator->log();

                    $this->setVariable('msgType',   'success');
                    $this->setVariable('msg',       'Migrazione dati effettuata correttamente');
                }
            }
        }

        $this->setTemplate('migrazione/migrazione.phtml');

        return $this->getOutput();
    }
}