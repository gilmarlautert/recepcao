<?php

use Phinx\Migration\AbstractMigration;

class CriaBanco extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */

    public function up()
    {
        $convite = $this->table('convite', array('id' => true) );
        $convite
            ->addColumn('descricao', 'string', array('limit' => 255))
            ->save();

        $interessado = $this->table('interessado', array('id' => true) );
        $interessado
            ->addColumn('nome', 'string', array('limit' => 255))
            ->addColumn('endereco', 'string', array('limit' => 500))
            ->addColumn('telefone', 'string', array('limit' => 14))
            ->addColumn('data_nascimento', 'datetime')
            ->addColumn('convite_id', 'integer', array('null' => true))
            ->addForeignKey('convite_id', 'convite', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
            ->save();
    }


    public function down()
    {   
        $this->dropTable('convite');
        $this->dropTable('interessado');
    }
}
