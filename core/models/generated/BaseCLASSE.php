<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CLASSE', 'doctrine');

/**
 * BaseCLASSE
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_classe
 * @property integer $id_niveau
 * @property string $nom
 * @property NIVEAU $NIVEAU
 * @property Doctrine_Collection $POST_CLASSE
 * @property Doctrine_Collection $UTILISATEUR_CLASSE
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCLASSE extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('CLASSE');
        $this->hasColumn('id_classe', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => '4',
             ));
        $this->hasColumn('id_niveau', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '4',
             ));
        $this->hasColumn('nom', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('NIVEAU', array(
             'local' => 'id_niveau',
             'foreign' => 'id_niveau'));

        $this->hasMany('POST_CLASSE', array(
             'local' => 'id_classe',
             'foreign' => 'id_classe'));

        $this->hasMany('UTILISATEUR_CLASSE', array(
             'local' => 'id_classe',
             'foreign' => 'id_classe'));
    }
}