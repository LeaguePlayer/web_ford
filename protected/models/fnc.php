<?php
class fnc
{
	private $domains = array(
						'Для всех сайтов'=>0,
                        'ford1.loc'=>1,
                        'ford2.loc'=>2,
                        'ford3.loc'=>3,                        
                       
                      );
	
	
    public static function mpr($array)
    {
          echo  "<pre>";
            print_r($array);
           echo  "</pre>";
          
    }
    
	
	public static function diffDate($date_2, $date_1=false)
	{
		
		$time_date_2 = strtotime($date_2);
		
		if($date_1)
			$time_date_1 = strtotime($date_1);
		else
			$time_date_1 = strtotime(date('Y-m-d H:i:s'));
			
			
		$result[days] = ( ( ($time_date_2 - $time_date_1)/(60*24*60) ) );
		
		
	//	$result[hours] = floor( (  ($time_date_2 - $time_date_1)/(60*60) ) - ($result[days]*24 )  );
		
		
	//	$result[minutes] =floor ( ( ($time_date_2 - $time_date_1)/60 ) - ($result[hours]*60+$result[days]*24*60) );
		
	//	$result[seconds] = ( ($time_date_2 - $time_date_1) - ($result[hours]*60*60+$result[days]*24*60*60 + $result[minutes]*60) ) ;
		
		
		
		
		return $result[days];
			
			
	}
	
	
	
    public static function code($message)
    {
        return iconv('cp1251','utf-8',$message);
    }
    
    public static function getRealWord($number,$string_for_1='день',$string_for_2='дня',$string_for_6='дней')
    {
      

        if($number<=20)
        {
            switch ($number)
            {
                case 1:
                $number .= ' '.$string_for_1; 
                break;                   
                case 2:
                $number .= ' '.$string_for_2; 
                break;
                case 3:
                $number .= ' '.$string_for_2; 
                break;
                case 4:
                $number .= ' '.$string_for_2; 
                break;
                default:
                $number .= ' '.$string_for_6; 
                break;
            }
        }
        else
        {
            switch (substr($number,0,-1))
            {
                case 1:
                $number .= ' '.$string_for_1; 
                break;
                case 5:
                $number .= ' '.$string_for_1; 
                break;
                case 2:
                $number .= ' '.$string_for_2; 
                break;
                case 3:
                $number .= ' '.$string_for_2; 
                break;
                case 4:
                $number .= ' '.$string_for_2; 
                break;
                default:
                $number .= ' '.$string_for_6; 
                break;
            }
        }
        return $number;
    }
    
    
    public static function saveIMG($file_name,$root,$model,$wish_name='')
    {          
        if($wish_name=='')
        {
            if ($file_name != '')
            {
              
                $pngjpggif = substr($file_name, -4);
                if ($pngjpggif == '.png' || $pngjpggif == '.gif' || $pngjpggif == '.jpg')
                {
                    $file_name = md5(md5($file_name) . md5(time()));
                    $file_name_small = $file_name . '_small' . $pngjpggif;
                    $file_name = $file_name . $pngjpggif;


                    $model->photo = CUploadedFile::getInstance($model, 'photo');


if(is_object($model))
                    $model->photo->saveAs($root . $file_name);
           
                    Yii::import('ext.phpthumb.EasyPhpThumb');
                    $thumbs = new EasyPhpThumb();
                    $thumbs->init();
                    $thumbs->setThumbsDirectory('/'.$root);
               
                    $thumbs
                    ->load($_SERVER["DOCUMENT_ROOT"].Yii::app()->request->baseUrl.'/'.$root.$file_name)                    
                    ->resize(800,800)
                    ->save($file_name, strtoupper(substr($pngjpggif,1)));
                    
                    
                    
                    $thumbs
                    ->load($_SERVER["DOCUMENT_ROOT"].Yii::app()->request->baseUrl.'/'.$root.$file_name)                    
                    ->resizeByGhz(75,75)
                    ->save($file_name_small, strtoupper(substr($pngjpggif,1)));
                    
                    $model->photo = $file_name;
                          
                } else
                    throw new CHttpException(404, 'Неправильный формат изображения!');

            }
            else unset($model->photo);
            return $model;
        }
        else
        {
            if ($file_name != '')
            {
              
                $pngjpggif = substr($file_name, -4);
                if ($pngjpggif == '.png' || $pngjpggif == '.gif' || $pngjpggif == '.jpg')
                {
                    
                    $file_name = $wish_name . $pngjpggif;


                    $model->alt_name = CUploadedFile::getInstance($model, 'photo');



                    $model->alt_name->saveAs($root . $file_name);
           
                    Yii::import('ext.phpthumb.EasyPhpThumb');
                    $thumbs = new EasyPhpThumb();
                    $thumbs->init();
                    $thumbs->setThumbsDirectory('/'.$root);
               
                    $thumbs
                    ->load($_SERVER["DOCUMENT_ROOT"].Yii::app()->request->baseUrl.'/'.$root.$file_name)
                    
                    ->resize(800,800)
                    ->save($file_name, strtoupper(substr($pngjpggif,1)));
                    $model->alt_name = $file_name;
                          
                } else
                    throw new CHttpException(404, 'Неправильный формат изображения!');

            }
            else unset($model->alt_name);
            return $model;
        }
            
    }
    
    
    public static function getThumb($folders,$file_name,$w=false,$h=false,$q=90)
    {
        $way_to_library = "/lib/thumb/phpThumb.php?src=/";
        if(is_numeric($w)) $w = "&w=$w";
        else $w='';
        if(is_numeric($h)) $h = "&h=$h";
        else $h='';        
        $q = "&q=$q";
        
        return  $way_to_library.$folders.$file_name.$w.$h.$q;
    }
    
    public static function gerRelationTable($n=false)
    {
        $list = array('none'=>'Не привязывать','gallery'=>"Галерею",'href'=>'Внешняя ссылка','notes'=>'Страницу','photoblog/index/type'=>'Фото-блок');
        if(is_numeric($n))
        {
            return $list[$n];
        }
        else return $list;
    }
    
    
    public static function getTypeCategory()
    {
        return 
        array
        (
            0=>'Блок информации (МегаМастер, Доставка и т.п.)',
            1=>'Фото блок (Бронирование, аренда)',     
            2=>'Горизонтальный вывод информации (Добрые дела и т.п.)',       
            3=>'Горизонтальный вывод информации c обратным звонком',  
            4=>'Новости',    
        );
    }
    
    
        public static function getCalendarDay($date)
    {
        $list_mounth = array('Jan'=>'Января','Feb'=>'Февраля','Mar'=>'Марта','Apr'=>'Апреля','May'=>'Мая','Jun'=>'Июня','Jul'=>'Июля','Aug'=>'Августа','Sep'=>'Сентября','Oct'=>'Октября','Nov'=>'Ноября','Dec'=>'Декабря');
        $month = date('M',strtotime($date));
        $month = $list_mounth[$month];
        $day =  date('d',strtotime($date));
        $year =  date('Y',strtotime($date));
        return $day.' '.$month.' '.$year;
    }
    
    public static function getCalendarDayById($date)
    {
        $list_mounth = array('1'=>'Января','2'=>'Февраля','3'=>'Марта','4'=>'Апреля','5'=>'Мая','6'=>'Июня','7'=>'Июля','8'=>'Августа','9'=>'Сентября','10'=>'Октября','11'=>'Ноября','12'=>'Декабря');
      
        return $list_mounth[$date];
    }
    
       public static function sendMail($subject,$message,$to='',$from='')    
    {
        if($to=='') $to = Yii::app()->params['adminEmail'];
        if($from=='') $from = 'no-reply@torsim.ru';
        $headers = "MIME-Version: 1.0\r\nFrom: $from\r\nReply-To: $from\r\nContent-Type: text/html; charset=utf-8";
	    $message = wordwrap($message, 70);
	    $message = str_replace("\n.", "\n..", $message);
	    mail($to,'=?UTF-8?B?'.base64_encode($subject).'?=',$message,$headers);
    }
    
    
    public static function form_credit($id=false)
    {
        $list = array('Авто','Ипотека','Потребительский','Бизнес');
        if(is_numeric($id))
            return $list[$id];
        else
            return $list;
    }
    
    public function strahovanie($id=false)
    {
        $list = array(
        'kasko'=>'КАСКО',
        'osago'=>'ОСАГО',
        'home'=>'Имущество',
        'live'=>'Жизнь',
        'business'=>'Бизнес',
        );
        if($id)
            return $list[$id];
        else
            return $list;
    }
    

    public function MoneyType($type)
    {
        switch ($type)
        {
            case 1:
                return "Наличные";
            break;
            case 2:
                return "Безналичный";
            break;
            case 3:
                return "Призовой";
            break;
            default:
                return "Наличные";
            break;
        }
    }
    
    //    1 – заказ принят (в этом состоянии машину клиенту на сайте не показывать!)
//    2 – подача машины / отзвонка (теперь водитель известен)
//    3 – выполнение
//    4 – выполнен
//    5 – отменен
    public function getStatus($status)
    {
        $array = array(
                        1=>"заказ принят",
                        2=>"подача машины",
                        3=>"выполнение",
                        4=>"выполнен",
                        5=>"отменен",
                      );
                      
        return $array[$status];
    }
    


    public function getTypeWork($id)
    {
        $array = array(
                        1=>"Такси",
                        32=>"Грузовая перевозка",
                        40=>"Домашний мастер",                        
                        50=>"Бюро добрых услуг",
                      );
                      return $array[$id];
    }
	
	
	
	public function returnIDSetting($domain)
    {
         return $this->domains[$domain];
    }
	
	public function returnAvailableDomains($id_site)
	{
		if($id_site==0)
		{
			$result = array_flip($this->domains);
		}
		else
		{
			$value = array_search($id_site, $this->domains);	
			$result = array($id_site => $value);
		}
		
		
		
		return $result;
	}
	
	public static function returnDomains($n=false)
	{
		$fnc = new Fnc;
		$result = array_flip($fnc->domains);
		
		
		if(is_numeric($n))
			return $result[$n];
		else return $result;
	}
	
	public static function menuCategories($n=false)
	{
		
		$result = array(
							'Легковые автомобили',
							'Автомобили в наличии',
							'Коммерческие автомобили',
							'Корпоративные клиенты',
							'О дилере',
							'О Ford',
		);
		
		
		if(is_numeric($n))
			return $result[$n];
		else return $result;
	}
	
	
	public static function returnYesNo($n=false)
	{
		
		$result = array(
							0=>"Нет",
							1=>"Да",
		);
		
		
		if(is_numeric($n))
			return $result[$n];
		else return $result;
	}
	
    
}
?>