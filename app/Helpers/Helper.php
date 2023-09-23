<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id=0, $char ='' ) {
        $html='';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>'. $menu->id .'</td>
                        <td>'. $char . $menu->name .'</td>
                        <td>'. self::active($menu->active). '</td>
                        <td>'. $menu->updated_at .'</td>
                        <td>&nbsp;</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$menu->id.'">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm" onClick="removeRow('.$menu->id.', \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char.'!--');
            }
        }
        return $html;
    }
    public static function active($active =0) : string {
        return $active == 0 ? '
        <span class = "btn btn-danger btn-xs">NO</span>' :
        '<span class = "btn btn-success btn-xs">YES</span>';
    }

    public static function activeComment($comment_status, $comment_id, $comment_product_id) : string {
        return $comment_status == 0 ? '
        <input type="button" data-comment_status="1" data-comment_id="'. $comment_id.'" id="'. $comment_product_id.'"
                class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt">' :
        '<input type="button" data-comment_status="0" data-comment_id="'. $comment_id.'" id="'. $comment_product_id.'"
                class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt">';
    }

    public static function product($products, $menu_id=0, $char ='' ) {
        $html='';

        foreach ($products as $key => $menu) {
            if ($menu->menu_id == $menu_id) {
                $html .= '
                    <tr>
                        <td>'. $menu->id .'</td>
                        <td>'. $char . $menu->name .'</td>
                        <td>'. self::active($menu->active). '</td>
                        <td>'. $menu->updated_at .'</td>
                        <td>&nbsp;</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/products/edit/'.$menu->id.'">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm" onClick="removeRow('.$menu->id.', \'/admin/products/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($products[$key]);
                $html .= self::menu($products, $menu->id, $char.'!--');
            }
        }
        return $html;
    }

    public static function menus($menus, $parent_id = 0) :string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            ' . $menu->name . '
                        </a>';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }

    public static function price($price =0, $price_sale =0) {
        if ($price_sale != 0)
            return $price_sale;
        if ($price != 0)
            return $price;
        return '<a href="/lien-he.html">Liên hệ</a>';
    }


}
