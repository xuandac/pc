<?php
namespace app\services;
use yii\widgets\LinkPager;
class Page extends LinkPager{
    public function __construct($config = array()) {
        parent::__construct($config);
    }
    public function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $tag = ArrayHelper::remove($this->disabledListItemSubTagOptions, 'tag', 'span');

            return Html::tag('li', Html::tag($tag, $label, $this->disabledListItemSubTagOptions), $options);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::tag('li', Html::a($label, "?page=".($page+1), $linkOptions), $options);
    }
}
/* 
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 29, 2017, 10:40:24 AM. 
 * *********************************************
 */

