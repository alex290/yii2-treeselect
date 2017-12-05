Select Tree Map - массив из масива с `parent_id`
===============


Установка
------------

Предпочтительный способ установки этого расширения через [composer](http://getcomposer.org/download/).

Запустить

	php composer.phar require --prefer-dist alex290/yii2-treeselect "*"

или добавить

	"alex290/yii2-treeselect": "*"


в секцию require вашего `composer.json` файла.


Использование
-----

После установки расширения, просто использовать его в вашем коде:

	$map = app\models\Category::find()->indexBy('id')->orderBy('weight')->asArray()->all();

Забираем массив из объекта категории где должно быть обязательное поле `parent_id`

Подключаем новую модель

	$treeSelect = new \alex290\treeselect\TreeSelect();

и например в форме выводим

	<?= $form->field($model, 'parent_id')->dropDownList(yii\helpers\ArrayHelper::merge(['0' => 'Основной'], $treeSelect->getTree($map))) ?>

где `$treeSelect->getTree($map)` Вызывается простой массив ['id объекта' => 'Название']. А дочерние элементы вслед за главным с префиксом '-' 