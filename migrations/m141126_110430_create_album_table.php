<?php

class m141126_110430_create_album_table extends EDbMigration
{
        public $prefix = 'album_';

        public function up()
	{
            $this->createTable($this->prefix.'album', [
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'description'=>'TEXT(500) NULL',
                'created_at'=>'DATETIME NULL',
                'updated_at'=>'DATETIME NULL',
                'created_by'=>'int',
                'updated_by'=>'int'
            ]);
            
            $this->createTable($this->prefix.'image', [
                'id'=>'pk',
                'album_id'=>'int NOT NULL',
                'name'=>'varchar(100) NOT NULL',
                'description'=>'varchar(255) NOT NULL',
                'created_at'=>'DATETIME NULL',
                'updated_at'=>'DATETIME NULL'
            ]);
            
            $this->addForeignKey($this->prefix.'fk_album', $this->prefix.'image', 'album_id', $this->prefix.'album', 'id','CASCADE','CASCADE');
	}

	public function down()
	{
            $this->dropForeignKey($this->prefix.'fk_album',$this->prefix.'image');
            $this->dropTable($this->prefix.'album');
            $this->dropTable($this->prefix.'image');
	}
}