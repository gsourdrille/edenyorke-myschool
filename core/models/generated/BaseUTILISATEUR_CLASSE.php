<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('UTILISATEUR_CLASSE', 'doctrine');

/**
 * BaseUTILISATEUR_CLASSE
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_classe
 * @property integer $id_user
 * @property UTILISATEUR $UTILISATEUR
 * @property CLASSE $CLASSE
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUTILISATEUR_CLASSE extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('UTILISATEUR_CLASSE');
        $this->hasColumn('id_classe', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => '4',
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UTILISATEUR', array(
             'local' => 'id_user',
             'foreign' => 'id_user'));

        $this->hasOne('CLASSE', array(
             'local' => 'id_classe',
             'foreign' => 'id_classe'));
    }
}