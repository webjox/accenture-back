<h4>Основной стек технологий:</h4>
<ul>
	<li>HTML, CSS, JavaScript</li>
	<li>React (Next.js)</li>
	<li>Git</li>
	<li>Php 7.4, Yii2, MySQL</li>
 </ul>
<h4>Демо</h4>
<p>Демо сервиса доступно по адресу: http://185.251.91.22/ </p>


УСТАНОВКА
------------
### Установка проекта

Выполните
~~~
git clone https://github.com/webjox/accenture-back.git
cd accenture-back
composer install 
~~~
Подключение к базе данных
~~~
cd config 
vi db.php
Поменяйте данные на свои для подключения к MySQL
~~~
Дамп базы находится в корне проекта.
Для его запуска выполните: 

~~~
mysql -u<login> -p <database> < /path/to/file 
~~~

Готово! Проект успешно развернут

