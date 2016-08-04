<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/2/16
 * Time: 2:11 PM
 */

namespace App\Breadcrumbs;


class Breadcrumbs
{
    public static function makeFor(Breadcrumbable $model)
    {
        $trail = collect();

        while($model) {
            $trail->push([
                'href' => $model->getModelUrl(),
                'name' => $model->getBreadcrumbName()
            ]);

            $model = $model->getModelParent();
        }

        $trail->push(['href' => '/', 'name' => 'home']);

        return $trail->reverse()->values()->toArray();
    }
}