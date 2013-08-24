<?php
/**
 * Миграция m130824_075858_cars
 *
 * @property string $prefix
 */
 
class m130824_075858_cars extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{cars}}');
 
    public function __construct()
    {
        $this->execute('SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;');
        $this->execute('SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;');
        $this->execute('SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE="NO_AUTO_VALUE_ON_ZERO";');
    }
 
    public function __destruct()
    {
        $this->execute('SET SQL_MODE=@OLD_SQL_MODE;');
        $this->execute('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;');
        $this->execute('SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;');
    }
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{cars}}', array(
            'id' => 'pk', // auto increment
			
			//'id_category' => "int(11) COMMENT 'категория выставленного авто: новые/транзит/в на'",	
			
			'name' => "string COMMENT 'название авто'",	
			'image' => "string COMMENT 'фото авто'",	
			
			'price' => "integer COMMENT 'стоимость авто начинается от'",	
			
			'video1' => "text COMMENT 'видео появляется на карточке товара. до 3х штук'",	
			'video2' => "text COMMENT 'видео появляется на карточке товара. до 3х штук'",	
			'video3' => "text COMMENT 'видео появляется на карточке товара. до 3х штук'",	
			'meta_title' => "string COMMENT 'для сеошника'",	
			'meta_keys' => "text COMMENT 'для сеошника'",	
			'meta_desc' => "text COMMENT 'для сеошника'",	
			'gallery' => "integer COMMENT 'фотогалерея авто'",	
			
			
			//'<your_field>' => "<type> COMMENT 'Комментарий'",
			
			'status' => "tinyint COMMENT 'Статус'",
			'sort' => "integer COMMENT 'Вес для сортировки'",
            'create_time' => "integer COMMENT 'Дата создания'",
            'update_time' => "integer COMMENT 'Дата последнего редактирования'",
        ),
        'ENGINE=MyISAM');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}