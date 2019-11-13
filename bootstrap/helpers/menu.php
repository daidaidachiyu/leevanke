<?php
/*
 * 菜单渲染功能
 *
 */

/*
 * 渲染成菜单
 */
function getMenu(){
    $getChild=getChild(config("menu.List"));
    return $getChild[0];
}

/*
 * 将数组解析成html
 */
function getChild($parents)
{
    $childUl = "";
    $display = false;

    for ($i = 0; $i < sizeof($parents); $i++) {

        if (isset($parents[$i]['children'])) { //判断是否当前元素是否有子节点

            $childNode = getChild($parents[$i]['children']); //返回子节点
            if($childNode[1])$display=true;
            //把子字节点放入父节点文本之后
            $childUl .= createLiFather($parents[$i],$childNode[0],$childNode[1]);
        } else {
            $li = createLi($parents[$i]);
            $childUl .= $li[0];
            if($li[1])$display=true;
        }


    }
    $childUl = createUl($childUl,$display); //兄弟节点放在一起
    return [$childUl,$display];
}

/*
 * <li>标签子组件
 */
function createLi($parent){
    $url = "";
    $display = "";
    $flag = false;
    if(isset($parent["route"])){
        $url = route($parent["route"]);
        if($url == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']){
            $display = "class=\"active\"";
            $flag = true;
        }
        $url = "href = $url";
    }
    $name = $parent["name"];
    return ["<li>
                <a $url $display>
                    <i class=\"iconfont\">&#xe6a7;</i>
                    <cite>$name</cite>
                </a>
            </li>",$flag];
}

/*
 * <li>标签父组件
 */
function createLiFather($parent,$chilNode,$display){
    $name = $parent["name"];
    $icon = "&#xe6b8";
    $class = "";
    $arrow ="&#xe697";
    //检查是否应该拉伸菜单
    if($display){
        $class = "class=\"open\"";
        $arrow = "&#xe6a6";
    }
    //检查是否设置icon属性
    if(isset($parent["icon"])){
        $icon = $parent["icon"];
    }
    return "<li $class>
                <a href=\"javascript:;\">
                <i class=\"iconfont left-nav-li\" lay-tips=\"$name\">$icon;</i>
                <cite>$name</cite>
                <i class=\"iconfont nav_right\" style=\"font-size: 14px; display: inline;\">$arrow;</i></a>$chilNode
            </li>";
}

/*
 * <ul>标签
 */
function createUl($childUl,$display){
    $style = "";
    if($display){
        $style = "style=\"display: block;\"";
    }
    return "<ul class=\"sub-menu\" $style>" . $childUl . "</ul>";
}
