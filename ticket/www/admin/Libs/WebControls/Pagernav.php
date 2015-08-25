<?php
/**
 * 定义 PagerNav 控件
 *
 * 要使用该控件，指定应用程序设置 webControlsExtendsDir 为该文件所在的目录，
 * 例如 webControlsExtendsDir = APP_DIR . '/WebControls';
 *
 * 在控制器中，用 FLEA_Helper_Pager 分页，并且：
 *
 * <code>
 * // 分页
 * FLEA::loadHelper('pager');
 * $pager = new FLEA_Helper_Pager($tableProducts, $currentPage, $pageSize);
 *
 * // 准备模板需要的数据
 * $viewdata = array(
 *     'rowset' => $pager->findAll(),
 *     'pagerData' => $pager->getPagerData(), // pagerData 用于 PagerNav 控件
 * );
 *
 * // 显示模板
 * $this->_executeView('products_list.html', $viewdata);
 * </code>
 *
 * 然后在模板中（以 Smarty 为例）用下列代码即可：
 *
 * {{ webcontrol type="pagernav" name="pagenav" pager=$pagerData controller="Products" action="List" }}
 *
 * --------------------------------
 *
 * 如何扩展更多的 WebControls 控件？
 *
 * 每一个 WebControls 控件都有一个唯一的类型，例如 PageJumper、NewsList；
 * 每一个 WebControls 控件对应一个函数，函数名字是“_ctl控件类型”；
 * 而该函数所在的文件，文件名必须是第一个字母大写，其他字母小写；
 * 定义控件函数的文件必须位于应用程序设置 webControlsExtendsDir 指定的目录中。
 *
 * @author 廖宇雷 dualface@gmail.com
 */

function _ctlPagernav($name, $attribs)
{
    /**
     * FLEA_WebControls::extractAttribs() 从 $attribs 数组中导出一个包含指定选项的数组，
     * 导出的同时，会从 $attribs 中删除这些指定的选项。
     *
     * 返回的数组包含所有指定的选项。
     * 如果指定的选项没有在 $attribs 中找到，则该选项的值为 null。
     */
    $opts = array('pager', 'controller', 'action' , 'param', 'length', 'slider', 'prevLabel', 'nextLabel');
    $data = FLEA_WebControls::extractAttribs($attribs, $opts);
    
    /**
     * FLEA_WebControls::mergeAttribs() 用于将 $attribs 中嵌套的数组合并到 $attribs 中。
     */
    FLEA_WebControls::mergeAttribs($attribs);
    
    $attribs['param'] = $data['param'];
    
    if ($data['slider'] <= 0) { $data['slider'] = 2; }
    if ($data['length'] <= 0) { $data['length'] = 10; }
    if ($data['prevLabel'] == '') { $data['prevLabel'] = '上一页'; }
    if ($data['nextLabel'] == '') { $data['nextLabel'] = '下一页'; }

    $output = "<ul";
    if ($name) {
        $name = h($name);
        $output .= " id=\"{$name}\"";
    }
    $output .= ">\n";

	//dump($data['pager']);
    if ($data['pager']['currentPage'] == $data['pager']['firstPage']) {
        $output .= "<li class=\"disabled\">&#171; {$data['prevLabel']}</li>\n";
    } else {
        $attribs['page'] = $data['pager']['prevPage'];
        $url = url($data['controller'], $data['action'], $attribs);
        $output .= "<li><a href=\"{$url}\">&#171; {$data['prevLabel']}</a></li>\n";
    }

    $currentPage = $data['pager']['currentPage'];
    $mid = intval($data['length'] / 2);
    if ($currentPage < $data['pager']['firstPage']) {
        $currentPage = $data['pager']['firstPage'];
    }
    if ($currentPage > $data['pager']['lastPage']) {
        $currentPage = $data['pager']['lastPage'];
    }

    $begin = $currentPage - $mid;
    if ($begin < $data['pager']['firstPage']) { $begin = $data['pager']['firstPage']; }
    $end = $begin + $data['length'] - 1;
    if ($end >= $data['pager']['lastPage']) {
        $end = $data['pager']['lastPage'];
        $begin = $end - $data['length'] + 1;
        if ($begin < $data['pager']['firstPage']) { $begin = $data['pager']['firstPage']; }
    }

    if ($begin > $data['pager']['firstPage']) {
        for ($i = $data['pager']['firstPage']; $i < $data['pager']['firstPage'] + $data['slider'] && $i < $begin; $i++) {
            $attribs['page'] = $i;
            $in = $i + 1;
            $url = url($data['controller'], $data['action'], $attribs);
            $output .= "<li><a href=\"{$url}\">{$in}</a></li>\n";
        }

        if ($i < $begin) {
            $output .= "<li class=\"none\">...</li>\n";
        }
    }

    for ($i = $begin; $i <= $end; $i++) {
        $attribs['page'] = $i;
        $in = $i + 1;
        if ($i == $data['pager']['currentPage']) {
            $output .= "<li class=\"current\">{$in}</li>\n";
        } else {
            $url = url($data['controller'], $data['action'], $attribs);
            $output .= "<li><a href=\"{$url}\">{$in}</a></li>\n";
        }
    }

    if ($data['pager']['lastPage'] - $end > $data['slider']) {
        $output .= "<li class=\"none\">...</li>\n";
        $end = $data['pager']['lastPage'] - $data['slider'];
    }

    for ($i = $end + 1; $i <= $data['pager']['lastPage']; $i++) {
        $attribs['page'] = $i;
        $in = $i + 1;
        $url = url($data['controller'], $data['action'], $attribs);
        $output .= "<li><a href=\"{$url}\">{$in}</a></li>\n";
    }

    if ($data['pager']['currentPage'] == $data['pager']['lastPage']) {
        $output .= "<li class=\"disabled\">{$data['nextLabel']} &#187;</li>\n";
    } else {
        $attribs['page'] = $data['pager']['nextPage'];
        $url = url($data['controller'], $data['action'], $attribs);
        $output .= "<li><a href=\"{$url}\">{$data['nextLabel']} &#187;</a></li>\n";
    }

    $output .= "</ul>\n";

	return $output;
}
