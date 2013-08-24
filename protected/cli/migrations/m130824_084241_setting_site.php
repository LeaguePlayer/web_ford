<?php
/**
 * Миграция m130824_084241_setting_site
 *
 * @property string $prefix
 */
 
class m130824_084241_setting_site extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{setting_site}}');
 
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
 
        $this->createTable('{{setting_site}}', array(
            'id' => 'pk', // auto increment
			
			'link_on_facebook' => "string COMMENT 'Ссылка на группу в фейсбук'",
			'link_on_vk' => "string COMMENT 'Ссылка на группу в вконтакте'",
			'link_on_twitter' => "string COMMENT 'Ссылка на твиттер'",
			'link_on_webcam' => "string COMMENT 'Ссылка на вебкамеру'",
			
			'email_main_admin' => "string COMMENT 'Почта главного администратора'",
			'email_test_drive' => "string COMMENT 'Почта для получения заявок на тест-драйв'",
			'email_feedback' => "string COMMENT 'Почта для получения заявок с сайта'",
			'email_strahovanie' => "string COMMENT 'Почта для получения заявок по страхованию'",
			'email_service' => "string COMMENT 'Почта для получения заявок на сервис'",
			'email_credit' => "string COMMENT 'Почта для получения заявок на кредит'",
			
			'phone_code_city' => "string COMMENT 'Код города'",
			'phone_sales' => "string COMMENT 'Телефон отдела продаж'",
			'phone_service' => "string COMMENT 'Телефон сервисного обслуживания'",
			
			'street' => "string COMMENT 'Адрес автосалона'",
			
			'access_to_test_drive' => "text COMMENT 'Автомобили доступные для тест-драйва'",
			'rows_stock_in_main' => "tinyint COMMENT 'Количество акций выводимых на главной страницы'",
			
			
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